<?php

namespace App\Http\Utilities;

use Carbon\Carbon;

//Models
use App\Booking;

class BookingUtilities
{

    /**
     * Notes here
     *
     * @return string
     */
    public function __construct(){}

    /**
     * TODO move to date utilities.
     * Check get available dates.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkTimeSlots(Booking $booking){

        /*
           First attempt, this is a little hacky but is on the correct lines.
           The Start times and end times are offset to create a new array that contains the start and
           end time between booked time slots.
        */

        if(!$bookingTimes = $booking->bookingTimes)
            return; // TODO implement error handler here.

        $startTimes = $bookingTimes->pluck('start_time');
        $endTimes = $bookingTimes->pluck('end_time');

        // These times that are outside of the offset range,
        // can also be handy to know the first and last time, so set them here for future use.
        $firstStartTime = $startTimes->shift();
        $lastEndTime = $endTimes->pop();

        // * Not sure about this, it's a little abstract.
        foreach ($endTimes as $key => $endTime){
            $timeSlots[] = ['startTime' => $endTime, 'endTime' => $startTimes[$key]];
        }

        // Add the startOf

        // The times between the booked time slots.
        foreach ($timeSlots as $timeSlot){

            $startTime = Carbon::parse($timeSlot['startTime']);
            $endTime = Carbon::parse($timeSlot['endTime']);
            $timeBetweenSlot = $startTime->diffInMinutes($endTime);

            if($timeBetweenSlot >= 5){
                dump( "Booking can be made between: " . $startTime->toTimeString() . " and " . $endTime->toTimeString() );
            }
        }

        /**
         * Dump on the data, just to see what it's doing.
         */
        dump(
            $startTimes,
            $endTimes,
            $timeSlots,
            $firstStartTime,
            $lastEndTime
        );

    }

}