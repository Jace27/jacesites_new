<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ArticlesUsers
 *
 * @property int $id
 * @property int $article_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Articles $article
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlesUsers whereUserId($value)
 * @mixin \Eloquent
 */
class ArticlesUsers extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'article_id',
        'user_id',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Articles::class, 'article_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
