<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    //
    public function assessmentSchedules()
    {
        return $this->hasMany(AssessmentSchedule::class);
    }
}
