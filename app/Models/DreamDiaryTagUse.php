<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DreamDiaryTagUse
 *
 * @property int $id
 * @property int $tag_id
 * @property int $uses
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DreamDiaryTags $tag
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagUse whereUses($value)
 * @mixin \Eloquent
 */
class DreamDiaryTagUse extends Model
{
    use HasFactory;

    protected $table = 'dreamdiary_tag_use';
    public $timestamps = true;
    protected $fillable = [
        'tag_id',
        'uses',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(DreamDiaryTags::class, 'tag_id');
    }
}
