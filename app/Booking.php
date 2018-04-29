<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    public function bookingTimes(){
        return $this->hasMany('App\BookingTime');
    }

}
