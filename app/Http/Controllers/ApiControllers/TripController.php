<?php

namespace App\Http\Controllers\ApiControllers;

use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    

    public function index( Request $request ) {
        $order = $request->order;
        $hills = $request->hills;

        $trips = Trip::take(10);

        if( $hills ) {
            $trips = $trips->whereIn( 'hill_id', $hills );
        }

        return $trips->orderBy('id', 'DESC')->get();
    }


    public function show( $id ) {
        return Trip::with('user')->with('hill')->findOrFail($id);
    }

    public function store( Request $request ) {
        $request->validate([
            'title'         => 'required|string',
            'description'   => 'required|string',
            'hill_id'       => 'required|exists:hills,id',
            'date'          => 'required'
        ]);

        $trip = new Trip();
        $trip->date = $request->date;
        $trip->title = $request->title;
        $trip->description = $request->description;
        $trip->user_id = Auth::user()->id;
        $trip->hill_id = $request->hill_id;
        $trip->duration = 0;
        $trip->avg_speed = 0;
        $trip->distance = 0;
        // $trip->save();
        
        return $trip;
    }


    public function update( Request $request ) {
        $request->validate([
            'title'         => 'required|string',
            'description'   => 'required|string',
            'date'          => 'required'
        ]);

        $trip = Trip::findOrFail( $request->id );
        
        $this->authorize('update', $trip);

        $trip->date = $request->date;
        $trip->title = $request->title;
        $trip->description = $request->description;
        
        $trip->save();
        
        return $trip;   
    }

    public function destroy( Request $request ) {
        $trip = Trip::findOrFail( $request->id );

        $trip->delete();
        
        return $trip;
    }

}
