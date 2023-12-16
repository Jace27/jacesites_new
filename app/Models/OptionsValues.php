<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OptionsValues
 *
 * @property int $id
 * @property int $user_id
 * @property int $option_id
 * @property string $value
 * @property int $hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Options $option
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionsValues whereValue($value)
 * @mixin \Eloquent
 */
class OptionsValues extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'option_id',
        'value',
        'hidden',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Options::class, 'option_id');
    }
}
