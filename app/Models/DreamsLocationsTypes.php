<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DreamsLocationsTypes extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function locations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DreamsLocations::class, 'dreams_locations_dreams_locations_types', 'type_id', 'location_id');
    }
}
