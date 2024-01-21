<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DreamDiaryRecords
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $date
 * @property string $title
 * @property string $description
 * @property int $hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DreamDiaryRecordImages> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DreamDiaryTags> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords query()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecords withoutTrashed()
 * @mixin \Eloquent
 */
class DreamDiaryRecords extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dreamdiary_records';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'date',
        'title',
        'description',
        'hidden',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(DreamDiaryTags::class, 'dreamdiary_records_tags', 'record_id', 'tag_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(DreamDiaryRecordImages::class, 'record_id');
    }
}
