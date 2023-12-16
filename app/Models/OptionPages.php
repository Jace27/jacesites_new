<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OptionPages
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Options> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|OptionPages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionPages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionPages query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionPages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionPages whereName($value)
 * @mixin \Eloquent
 */
class OptionPages extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(Options::class, 'page_id');
    }
}
