<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TitleEvents
 *
 * @property int $id
 * @property int|null $page_id
 * @property string|null $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SitePages|null $page
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents query()
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleEvents whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TitleEvents extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'page_id',
        'title',
        'description',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(SitePages::class, 'page_id');
    }
}
