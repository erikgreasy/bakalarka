<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{



    public function log( Request $request ) {
        $log = new Log();
        $log->trip_id = 9;
        $log->latitude = $request->lat;
        $log->longtitude = $request->long;

        $log->save();
    }

}
