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

}
