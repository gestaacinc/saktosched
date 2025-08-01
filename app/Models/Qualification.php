<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Qualification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'assessment_fee',
        'is_active',
    ];

    /**
     * Get the assessment schedules for the qualification.
     */
    public function assessmentSchedules(): HasMany
    {
        return $this->hasMany(AssessmentSchedule::class);
    }
}