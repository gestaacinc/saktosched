<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'qualification_id',
        'schedule_date',
        'max_slots',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'schedule_date' => 'datetime',
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}