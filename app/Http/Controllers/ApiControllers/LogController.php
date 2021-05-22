<?php

namespace App\Http\Controllers\ApiControllers;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{

    public function store(Request $request) {
        $log = new Log();
        $log->trip_id = $request->trip_id;
        $log->latitude = $request->lat;
        $log->longtitude = $request->long;
        $log->speed = $request->speed;

        $log->save();

        return $log;
    }
}
