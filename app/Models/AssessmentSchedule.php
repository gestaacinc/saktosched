<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentSchedule extends Model
{
    //
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
