<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terminal extends Model
{
    protected $fillable = ['terminal_name', 'city', 'address'];

    public function originRoutes(): HasMany { return $this->hasMany(Route::class, 'origin_terminal_id'); }
    public function destinationRoutes(): HasMany { return $this->hasMany(Route::class, 'destination_terminal_id'); }
}
