<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'assessment_schedule_id',
        'slots_reserved',
        'reservation_fee_paid',
        'payment_status',
        'booker_name',      // <-- ADD THIS
        'booker_email',     // <-- ADD THIS
        'booker_phone',     // <-- ADD THIS
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessmentSchedule(): BelongsTo
    {
        return $this->belongsTo(AssessmentSchedule::class);
    }
}
