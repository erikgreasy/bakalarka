<?php

namespace App\Http\Controllers;

use App\Hill;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{


    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'trips.index', [
            'trips' => Trip::all()
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'trips.create', [
            'hills' => Hill::all()
        ] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'              => 'required',
            'hill'              => 'required',
            'title'             => 'required',
            'description'       => 'required'
        ]);

        // print_r( $_POST );
        // die();
        
        $trip = new Trip();
        $trip->date = $request->date;
        $trip->title = $request->title;
        $trip->description = $request->description;
        $trip->user_id = Auth::user()->id;
        $trip->hill_id = $request->hill;

        $trip->save();
        // print_r( $trip );
        // die();


        return redirect('trips/' . $trip->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return view( 'trips.show', [
            'trip'  => $trip
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $this->authorize( 'update', $trip );
        return view( 'trips.edit', [
            'trip'  => $trip,
        ] );
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $this->authorize( 'update', $trip );
        $request->validate([
            'date'              => 'required',
            'title'             => 'required',
            'description'       => 'required'
        ]);

        $trip->date = $request->date;
        $trip->title = $request->title;
        $trip->description = $request->description;

        $trip->save();

        return redirect('trips/' . $trip->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $this->authorize( 'update', $trip );
        $trip->delete();
        return redirect('/trips');
    }
}
