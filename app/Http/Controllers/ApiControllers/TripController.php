<?php

namespace App\Http\Controllers\ApiControllers;

use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TripController extends Controller
{
    

    public function index() {
        return Trip::limit(10)->get();
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
        // $trip->user_id = Auth::user()->id;
        $trip->user_id = 1;
        $trip->hill_id = $request->hill_id;
        $trip->duration = 0;
        $trip->avg_speed = 0;
        $trip->distance = 0;
        $trip->save();
        
        return $trip;
    }

}
