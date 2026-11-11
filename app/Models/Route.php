<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    protected $fillable = ['origin_terminal_id', 'destination_terminal_id', 'distance', 'estimated_duration'];

    public function originTerminal(): BelongsTo { return $this->belongsTo(Terminal::class, 'origin_terminal_id'); }
    public function destinationTerminal(): BelongsTo { return $this->belongsTo(Terminal::class, 'destination_terminal_id'); }
    public function schedules(): HasMany { return $this->hasMany(Schedule::class); }
}
