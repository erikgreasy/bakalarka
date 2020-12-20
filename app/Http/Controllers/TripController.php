<?php

namespace App\Http\Controllers;

use App\Hill;
use App\Trip;
use App\TripImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'from_hill'     => Session::pull( 'hillId' ),
            'hills'         => Hill::all()
        ] );
    }







    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if( request()->ajax() ) {
        //     $request->date = date( 'Y-m-d h:i:s' );
        // }
        // print_r( $_POST );
        // die();
        $images = $request->file( 'image' );
        // print_r( $images );

        $request->validate([
            // 'date'              => 'required|before_or_equal: today',
            'hill'              => 'required',
            'title'             => 'required',
            'description'       => 'required'
        ]);
        $trip = new Trip();
        $trip->date = $request->date;
        $trip->title = $request->title;
        $trip->description = $request->description;
        $trip->user_id = Auth::user()->id;
        $trip->hill_id = $request->hill;

        if( isset( $images ) ) {

            foreach( $images as $index => $img ) {
                $trip_image = new TripImage();
                $trip_image->trip_id = $trip->id; 
                $path = Storage::disk('public')->putFile('uploads', $img );
                $trip_image->path = '/storage/' . $path;
                $trip_image->save();
    
                
                
            }
        }
        $trip->save();
        
        
        


        if( request()->ajax() ) {
            return [ 'trip_id'  => $trip->id ];
        }
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







    
    /**
     * DEVELOPMENT ONLY: please delete me later
     * 
     * New route in web.php that calls this function on POST request, handles buttton click on track view
     * that makes an ajax request and just stores some shit to db
     */
    public function handle_tracking_trip() {
        $trip = new Trip();
        $trip->date = '2020-11-15';
        $trip->title = 'abc';
        $trip->description = 'def';
        $trip->user_id = 1;
        $trip->hill_id = 1;
        $trip->save();

    }
}
