<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\DreamDiaryTags
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DreamDiaryTagUse $uses
 * @property-read \App\Models\DreamDiaryTagGroups $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DreamDiaryRecords> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags query()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryTags whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DreamDiaryTags extends Model
{
    use HasFactory;

    protected $table = 'dreamdiary_tags';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'group_id',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(DreamDiaryTagGroups::class, 'group_id');
    }

    public function records(): BelongsToMany
    {
        return $this->belongsToMany(DreamDiaryRecords::class, 'dreamdiary_records_tags', 'tag_id', 'record_id');
    }

    public function uses(): HasOne
    {
        return $this->hasOne(DreamDiaryTagUse::class, 'tag_id');
    }

    public function getUses(): int
    {
        /** @var DreamDiaryTagUse $uses */
        $uses = $this->uses()->firstOrCreate(['tag_id' => $this->id], ['uses' => 0]);
        return $uses->uses;
    }

    public function updateUses()
    {
        /** @var DreamDiaryTagUse $uses */
        $uses = $this->uses()->firstOrNew(['tag_id' => $this->id]);
        $uses->uses = $this->records()->count();
        $uses->save();
    }

    public static function orderByUses($order = 'asc'): Builder
    {
        return self::query()
            ->select(['t.*'])
            ->from((new self())->getTable(), 't')
            ->join((new DreamDiaryTagUse())->getTable().' as u', 'u.tag_id', '=', 't.id', 'left')
            ->orderBy('u.uses', $order);
    }
}
