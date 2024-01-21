<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DreamDiaryRecordImages
 *
 * @property int $id
 * @property int $record_id
 * @property string $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DreamDiaryRecords $record
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DreamDiaryRecordImages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DreamDiaryRecordImages extends Model
{
    use HasFactory;

    protected $table = 'dreamdiary_record_images';
    public $timestamps = true;
    protected $fillable = [
        'record_id',
        'filename',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(DreamDiaryRecords::class, 'record_id');
    }
}
