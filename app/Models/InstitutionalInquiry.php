<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstitutionalInquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_name',
        'representative_name',
        'email',
        'phone',
        'qualification_id',
        'num_applicants',
        'status',
    ];

    /**
     * Get the qualification associated with the inquiry.
     */
    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }
}