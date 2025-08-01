<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification_id',
        'proposed_date',
        'tracking_number',
        'status',
        'rejection_reason',
        'proposer_name',
        'proposer_email',
        'proposer_phone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'proposed_date' => 'datetime', // <-- THIS IS THE LINE TO ADD
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }
}