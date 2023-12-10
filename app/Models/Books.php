<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Books
 *
 * @property int $id
 * @property string $slug
 * @property string|null $author
 * @property string $title
 * @property string|null $description
 * @property int|null $year
 * @property string $extension
 * @property int $private
 * @property int $ord
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Books newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Books newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Books query()
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereOrd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Books whereYear($value)
 * @mixin \Eloquent
 */
class Books extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'slug',
        'author',
        'title',
        'description',
        'year',
        'extension',
        'private',
        'ord',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
