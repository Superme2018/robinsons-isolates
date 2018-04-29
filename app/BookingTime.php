<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{

    // I will probably need to look up the bookingTime parent at some point.
    public function booking(){
        return $this->belongsTo('App\Booking');
    }

}
