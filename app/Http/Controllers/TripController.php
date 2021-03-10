<?php

namespace App\Http\Controllers;

use App\Hill;
use App\Trip;
use App\Mountain;
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
    public function index( Request $request )
    {
        $order = $request->order;
        $hills = $request->hills;

        $trips = Trip::take(10);

        if( $hills ) {
            $trips = $trips->whereIn( 'hill_id', $hills );
        }

        return view( 'trips.index', [
            'trips' => $trips->get()
        ]);
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

        $images = $request->file( 'image' );
        $thumbnail = $request->file( 'thumbnail' );

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
        $trip->duration = 0;
        $trip->avg_speed = 0;
        $trip->distance = 0;
        $trip->save();

        // $trip->thumbnail_path = $request->thumbnail;

        if( isset( $images ) ) {

            foreach( $images as $index => $img ) {
                $trip_image = new TripImage();
                $trip_image->trip_id = $trip->id; 
                $path = Storage::disk('public')->putFile('uploads', $img );
                $trip_image->path = '/storage/' . $path;
                $trip_image->save();
            }
        }
        if( isset( $thumbnail ) ) {
            $path = Storage::disk('public')->putFile('uploads', $thumbnail );
            $trip->thumbnail_path = '/storage/' . $path;
            $trip->save();
        }

        
        


        // if is ajax request, send back trip_id to redirect
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


        $thumbnail = $request->thumbnail;
        if( $thumbnail ) {
            $path = Storage::disk('public')->putFile('uploads', $thumbnail );
            $trip->thumbnail_path = '/storage/' . $path;
        }

        $remove_thumbnail = $request->remove_thumbnail;
        if($remove_thumbnail) {
            $trip->thumbnail_path = '/images/image-placeholder.png';
        }

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
    // public function handle_tracking_trip(Request $request) {
    //     $trip = new Trip();
    //     $trip->date = '2020-11-15';
    //     $trip->title = 'abc';
    //     $trip->description = 'def';
    //     $trip->user_id = Auth::user()->id;
    //     $trip->hill_id = $request->hill_id;
    //     $trip->save();

    // }

    public function filter() {
        return view( 'trips.filter', [
            'hills'     => Hill::all(),
            'mountains' => Mountain::all()
        ]);
    }

    public function addDuration( Request $request, Trip $trip ) {
        $trip = Trip::find( $trip->id );
        // return 
        $trip->duration = $request->duration;
        $trip->distance = $request->distance;
        $trip->avg_speed = $trip->logs->sum('speed');
        $trip->save();
    }


}

