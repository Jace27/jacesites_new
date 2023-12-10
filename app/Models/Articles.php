<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Articles
 *
 * @property int $id
 * @property string $slug
 * @property string|null $author
 * @property string $title
 * @property string $content
 * @property int|null $available_after
 * @property int $ord
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Articles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Articles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Articles onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Articles query()
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereAvailableAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereOrd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Articles withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Articles withoutTrashed()
 * @mixin \Eloquent
 */
class Articles extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $fillable = [
        'slug',
        'author',
        'title',
        'content',
        'available_after',
        'ord',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function is_available(int $user_id = null): bool
    {
        if (is_null($user_id)) $user_id = Auth::id();
        if (is_null($user_id)) return is_null($this->available_after);
        return is_null($this->available_after) ||
            ArticlesUsers::whereUserId($user_id)->whereArticleId($this->available_after)->exists();
    }

    public function read(int $user_id = null): void
    {
        if (is_null($user_id)) $user_id = Auth::id();
        if (is_null($user_id)) return;
        $entry = new ArticlesUsers();
        $entry->article_id = $this->id;
        $entry->user_id = $user_id;
        $entry->save();
    }

    public static function available(int $user_id = null): \Illuminate\Database\Eloquent\Collection|array
    {
        if (is_null($user_id)) $user_id = Auth::id();
        if (is_null($user_id))
            return self::query()->whereNull('available_after')->orderBy('ord')->get();
        return self::query()
            ->whereNull('available_after')
            ->orWhereIn(
                'available_after',
                ArticlesUsers::query()
                    ->select('id')
                    ->where('user_id', '=', $user_id)
            )
            ->orderBy('ord')
            ->get();
    }
}
