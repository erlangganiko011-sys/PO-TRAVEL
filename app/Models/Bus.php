<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    protected $fillable = ['bus_number', 'bus_name', 'bus_type', 'capacity', 'description', 'status'];

    public function seats(): HasMany { return $this->hasMany(Seat::class); }
    public function schedules(): HasMany { return $this->hasMany(Schedule::class); }
}
