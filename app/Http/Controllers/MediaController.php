<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function imageUpload(Request $request)
    {
        $files = $request->allFiles();
        $existed = scandir($_SERVER['DOCUMENT_ROOT'].'/images/temp');
        $uploaded = [];
        foreach ($files as $file){
            if (strpos($file->getMimeType(), 'image/') == 0){
                $name = time().'_'.rand().'.png';
                while(in_array($name, $uploaded) || in_array($name, $existed)) $name = time().'_'.rand().'.png';
                move_uploaded_file($file->getRealPath(), $_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$name);
                $uploaded[] = $name;
            }
        }
        return ['status' => 'success', 'files' => $uploaded];
    }

    public function fileUpload(Request $request)
    {
        $files = $request->allFiles();
        $existed = scandir($_SERVER['DOCUMENT_ROOT'].'/files');
        $uploaded = [];
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $ext = explode('.', $name);
            if (count($ext) > 1)
                $ext = '.'.$ext[count($ext) - 1];
            else
                $ext = '';

            $name = time().'_'.rand().$ext;
            while (in_array($name, $uploaded) || in_array($name, $existed)) $name = time().'_'.rand().$ext;
            move_uploaded_file($file->getRealPath(), $_SERVER['DOCUMENT_ROOT'].'/files/'.$name);
            $uploaded[] = $_SERVER['HTTP_ORIGIN'] . '/files/' . $name;
        }
        return ['status' => 'success', 'files' => $uploaded];
    }

    public function deleteTemp(Request $request)
    {
        unlink($_SERVER['DOCUMENT_ROOT'].'/images/temp/'.$request->input('image'));
        return ['status' => 'success'];
    }
}
