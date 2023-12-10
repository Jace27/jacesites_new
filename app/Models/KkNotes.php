<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KKNotes
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $content
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes query()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KkNotes extends Model
{
    use HasFactory;

    protected $table = 'kk_notes';
    public $timestamps = true;
    protected $fillable = [
        'slug',
        'name',
        'content',
        'active',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
