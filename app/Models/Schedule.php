<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $fillable = ['bus_id', 'route_id', 'departure_time', 'arrival_time', 'price', 'status'];
    protected $casts = ['departure_time' => 'datetime', 'arrival_time' => 'datetime', 'price' => 'decimal:2'];

    public function bus(): BelongsTo { return $this->belongsTo(Bus::class); }
    public function route(): BelongsTo { return $this->belongsTo(Route::class); }
    public function bookings(): HasMany { return $this->hasMany(Booking::class); }
    public function bookingDetails(): HasMany { return $this->hasMany(BookingDetail::class); }
}
