<?php

namespace App\Http\Controllers;

use App\Models\DreamDiaryRecordImages;
use App\Models\DreamDiaryRecords;
use App\Models\DreamDiaryTags;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;

class DreamDiaryController extends Controller
{
    public function add(Request $request)
    {
        if (is_null($user = auth()->user())) {
            return [
                'status' => 'error',
                'code' => 'not_authorized',
                'message' => 'Авторизируйтесь для добавления снов',
            ];
        }

        $request->validate([
            'date' => 'date|nullable',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'hide' => 'required|in:true,false',
            'tags' => 'string',
            'files' => 'string',
        ]);

        $dream = DreamdiaryRecords::query()->create([
            'user_id' => $user->id,
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'description' => str_replace(array("\r\n", "\r", "\n"), '<br>', $request->input('description')),
            'hidden' => $request->input('hide') === 'true' ? 1 : 0,
        ]);

        $files = json_decode($request->input('files'));
        mkdir($_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id);
        foreach ($files as $file) {
            $name = explode('_', explode('.', $file)[0])[0];
            do $rand = rand();
            while (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$name.'_'.$rand.'.png'));
            $name = $name.'_'.$rand.'.png';
            copy($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$file, $_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$name);
            unlink($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$file);
            DreamdiaryRecordImages::query()->create([
                'record_id' => $dream->id,
                'filename' => $name,
            ]);
        }

        $tags = json_decode($request->input('tags'), true);
        foreach ($tags as $tag) {
            if (DreamDiaryTags::whereId($tag['id'])->exists() === false) {
                $tag = DreamDiaryTags::query()->create(['name' => $tag['name']]);
                $dream->tags()->attach($tag->id);
            } else {
                $dream->tags()->attach($tag['id']);
            }
        }

        return [
            'status' => 'success',
            'id' => $dream->id,
        ];
    }

    public function edit(Request $request, int $id)
    {
        if (is_null($user = auth()->user())) {
            return [
                'status' => 'error',
                'message' => 'Авторизируйтесь для добавления снов',
            ];
        }

        $request->validate([
            'date' => 'date|nullable',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'hide' => 'required|in:true,false',
            'tags' => 'string',
            'files' => 'string',
        ]);

        $dream = DreamDiaryRecords::whereId($id)->firstOrFail();
        $dream->update([
            'user_id' => $user->id,
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'description' => str_replace(array("\r\n", "\r", "\n"), '<br>', $request->input('description')),
            'hidden' => $request->input('hide') === 'true' ? 1 : 0,
        ]);

        $files = json_decode($request->input('files'));
        foreach ($dream->images as $image) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$image->filename)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/temp/' . $image->filename);
            }
            $has = false;
            foreach ($files as $file) {
                if ($image->filename == $file) {
                    $has = true;
                    break;
                }
            }
            if (!$has) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$image->filename);
                $image->delete();
            }
        }
        foreach ($files as $file) {
            if ($dream->images()->where('filename', '=', $file)->exists() === false) {
                $name = explode('_', explode('.', $file)[0])[0];
                do $rand = rand();
                while (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$name.'_'.$rand.'.png'));
                $name = $name.'_'.$rand.'.png';
                copy($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$file, $_SERVER['DOCUMENT_ROOT'].'/images/dreams/'.$dream->id.'/'.$name);
                unlink($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$file);
                DreamdiaryRecordImages::query()->create([
                    'record_id' => $dream->id,
                    'filename' => $name,
                ]);
            }
        }

        $tags = json_decode($request->input('tags'), true);
        foreach ($dream->tags as $tag) {
            $has = false;
            foreach ($tags as $t) {
                if ($t['id'] == $tag->id) {
                    $has = true;
                    break;
                }
            }
            if (!$has) {
                $dream->tags()->detach($tag->id);
            }
        }
        foreach ($tags as $tag) {
            if (DreamDiaryTags::whereId($tag['id'])->exists() === false) {
                $tag = DreamDiaryTags::query()->create(['name' => $tag['name']]);
                $dream->tags()->attach($tag->id);
            } else if (!$dream->tags()->where('dreamdiary_tags.id', '=', $tag['id'])->exists()) {
                $dream->tags()->attach($tag['id']);
            }
        }

        return [
            'status' => 'success',
            'id' => $dream->id,
        ];
    }

    public function searchTags(Request $request)
    {
        try {
            $validated = $request->validate([
                'query' => 'required|string|max:255',
            ]);
        } catch (\Throwable $ex) {
            return [
                'status' => 'error',
                'message' => $ex->getMessage(),
            ];
        }
        $query = mb_strtolower($validated['query']);
        $tags = [];
        $found = DreamDiaryTags::orderByUses('desc')->where(new Expression('lower(`name`)'), 'like', "%$query%")->get();
        $all_records_count = DreamDiaryRecords::query()->count();
        $exists = false;
        /** @var DreamDiaryTags $tag */
        foreach ($found as $tag) {
            $tag->updateUses();
            $tags[] = [
                'id' => $tag->id,
                'name' => $tag->name,
                'uses' => $tag->getUses(),
                'rating' => $tag->getUses() / (double)($all_records_count ?: 1),
                'group' => [
                    'id' => $tag->group?->id,
                    'name' => $tag->group?->name,
                ],
            ];
            if ($query == $tag->name) {
                $exists = true;
            }
        }
        if (!$exists) {
            $tags = array_merge([[
                'id' => null,
                'name' => $query,
                'uses' => 0,
                'rating' => 0,
                'group' => [
                    'id' => null,
                    'name' => null,
                ],
            ]], $tags);
        }
        return [
            'status' => 'success',
            'data' => $tags,
        ];
    }
}
