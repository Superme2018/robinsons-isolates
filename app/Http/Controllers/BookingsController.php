<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

//Models
use App\Booking;

//Repositories
//use App\Http\Repositories\BookingsRepository;

//Utilities
use App\Http\Utilities\BookingUtilities;

class BookingsController extends Controller
{

    //Repositories
    //protected $bookingsRepository;

    //Utilities
    protected $bookingUtilities;

    private $startOfDay;
    private $endOfDay;

    /**
     * Using the construct to set the start and end of day for the time being.
     * Holding the data in the .evn for convenience.
    */
    public function __construct()
    {
        $this->startOfDay = env("START_OF_DAY");
        $this->endOfDay = env("END_OF_DAY");

        //$bookingsRepository = new BookingsRepository(); //Not needed at the moment, but will be used as this expands.
        $this->bookingUtilities = new BookingUtilities();
    }

    /**
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
            if(!$this->bookingUtilities->checkTimeSlots($bookedDate)){
                //Remove the date from the collection
            }
        }

        //return $bookedDates->pluck("reservation_date"); // Pluck will strip the 'reservation_date' and creates an array of only dates.

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
