<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\DreamDiaryTagGroups
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DreamDiaryTags> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups query()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTagGroups whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DreamDiaryTagGroups extends Model
{
    use HasFactory;

    protected $table = 'dreamdiary_tag_groups';
    public $timestamps = true;
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(DreamDiaryTags::class, 'group_id');
    }
}
