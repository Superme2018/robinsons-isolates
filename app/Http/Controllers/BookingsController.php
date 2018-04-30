<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

//Models
use App\Booking;

class BookingsController extends Controller
{

    /**
     * TODO move to repository.
     * Check get available dates.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookedDates(Request $request){

        if(!$request->get("targetMonth")) // The targetMonth is passed in from the front-end as "yyyy-mm" format.
          return; // TODO implement error handler here.

        if(!$month = Carbon::parse($request->get("targetMonth"))->month OR !$year = Carbon::parse($request->get("targetMonth"))->year)
          return; // TODO implement error handler here.

        if(!count($bookedDates = Booking::whereMonth('reservation_date', '=', $month)->whereYear('reservation_date', '=', $year)->get()))
          return; // TODO implement error handler here.

        // Do a check on the available times to see if any are free.
        foreach ($bookedDates as $bookedDate){
            if(!$this->checkTimeSlots($bookedDate)){
                //Remove the date from the collection
            }
        }

        //return $bookedDates->pluck("reservation_date"); // Pluck will strip the 'reservation_date' and creates an array of only dates.

    }

    /**
     * TODO move to date utilities.
     * Check get available dates.
     *
     * @return \Illuminate\Http\Response
     */
    private function checkTimeSlots(Booking $booking){

        /*
            First attempt, this is a little hacky but is on the correct lines.
            The Start times and end times are offset to create a new array that contains the start and end time between booked time slots.
        */

        if(!$bookingTimes = $booking->bookingTimes)
          return; // TODO implement error handler here.

        $startTimes = $bookingTimes->pluck('start_time');
        $endTimes = $bookingTimes->pluck('end_time');

        // These are the times that are outside of the offset range,
        // can be handy to know the first and last time.
        $firstStartTime = $startTimes->shift();
        $lastEndTime = $endTimes->pop();

        // *Not sure about this, it's a little abstract.
        foreach ($endTimes as $key => $endTime){
            $timeSlots[] = ['startTime' => $endTime, 'endTime' => $startTimes[$key]];
        }

        // The times between the booked time slots.
        foreach ($timeSlots as $timeSlot){

            $startTime = Carbon::parse($timeSlot['startTime']);
            $endTime = Carbon::parse($timeSlot['endTime']);
            $timeBetweenSlot = $startTime->diffInMinutes($endTime);

            if($timeBetweenSlot >= 5){
                dump( "Booking can be made between: " . $startTime->toTimeString() . " and " . $endTime->toTimeString() );
            }
        }

        dump(
            $startTimes,
            $endTimes,
            $timeSlots,
            $firstStartTime,
            $lastEndTime
        );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
