<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SitePages
 *
 * @property int $id
 * @property string $link
 * @property string $name
 * @property int $show_in_menu
 * @property int $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages query()
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereShowInMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SitePages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SitePages extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'link',
        'name',
        'show_in_menu',
        'priority',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
