<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamsLocations extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'slug',
        'name',
        'description',
        'map_coords',
        'map_shape',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function types(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DreamsLocationsTypes::class, 'dreams_locations_dreams_locations_types', 'location_id', 'type_id');
    }
}
