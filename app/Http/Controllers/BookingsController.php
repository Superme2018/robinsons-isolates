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
          return; //TODO implement error handler here.

        if(!$month = Carbon::parse($request->get("targetMonth"))->month OR !$year = Carbon::parse($request->get("targetMonth"))->year)
          return; //TODO implement error handler here.

        if(!count($bookedDates = Booking::whereMonth('reservation_date', '=', $month)->whereYear('reservation_date', '=', $year)->get(['reservation_date'])))
          return; //TODO implement error handler here.

        return $bookedDates->pluck("reservation_date"); // Pluck will strip the 'reservation_date' and creates an array of only dates.

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
