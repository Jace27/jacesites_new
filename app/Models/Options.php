<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Options
 *
 * @property int $id
 * @property string $name
 * @property string $input_attrs
 * @property int $type
 * @property int $page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OptionPages $page
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OptionsValues> $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Options newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Options newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Options query()
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereInputAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Options whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Options extends Model
{
    use HasFactory;

    const TYPE_AUTO = 1;
    const TYPE_CUSTOM = 2;
    const TYPE_ASSIGN = 3;

    public static function getTypes()
    {
        return [
            self::TYPE_AUTO => 'Автоматическое',
            self::TYPE_CUSTOM => 'Свободное',
            self::TYPE_ASSIGN => 'Присваиваемое',
        ];
    }

    public $timestamps = true;
    protected $fillable = [
        'name',
        'input_attrs',
        'type',
        'page_id',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(OptionPages::class, 'page_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(OptionsValues::class, 'option_id');
    }
}
