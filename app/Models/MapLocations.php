<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\MapLocations
 *
 * @property int $id
 * @property int $user_id
 * @property int $image_id
 * @property float $x
 * @property float $y
 * @property float $w
 * @property float $h
 * @property int $r
 * @property int $z
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DreamDiaryRecordImages $image
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations query()
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereH($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereW($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MapLocations whereZ($value)
 * @mixin \Eloquent
 */
class MapLocations extends Model
{
    use HasFactory;

    protected $table = 'map_locations';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'image_id',
        'x',
        'y',
        'w',
        'h',
        'r',
        'z',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function image(): BelongsTo
    {
        return $this->belongsTo(DreamdiaryRecordImages::class,'image_id');
    }
}
