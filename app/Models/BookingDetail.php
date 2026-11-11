<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    protected $fillable = ['booking_id', 'schedule_id', 'seat_id', 'price'];
    protected $casts = ['price' => 'decimal:2'];

    public function booking(): BelongsTo { return $this->belongsTo(Booking::class); }
    public function schedule(): BelongsTo { return $this->belongsTo(Schedule::class); }
    public function seat(): BelongsTo { return $this->belongsTo(Seat::class); }
}
