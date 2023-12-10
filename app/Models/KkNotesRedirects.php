<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KKNotesRedirects
 *
 * @property int $id
 * @property string $old_link
 * @property string $new_link
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects query()
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects whereNewLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KkNotesRedirects whereOldLink($value)
 * @mixin \Eloquent
 */
class KkNotesRedirects extends Model
{
    use HasFactory;

    protected $table = 'kk_notes_redirects';
    public $timestamps = false;
    protected $fillable = [
        'old_link',
        'new_link',
    ];
}
