<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = ['user_id', 'schedule_id', 'booking_code', 'total_price', 'status', 'booking_date'];
    protected $casts = ['booking_date' => 'datetime', 'total_price' => 'decimal:2'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function schedule(): BelongsTo { return $this->belongsTo(Schedule::class); }
    public function details(): HasMany { return $this->hasMany(BookingDetail::class); }
    public function payments(): HasMany { return $this->hasMany(Payment::class); }
}
