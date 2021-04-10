<?php

namespace App\Http\Controllers\ApiControllers;

use App\Hill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HillController extends Controller
{
    public function index( Request $request ) {
        $hills = Hill::take(10);
        if( isset( $request->mountains ) ) {
            $mountains = $request->mountains;
            $hills = $hills->whereIn( 'mountain_id', $mountains );
        }
        if( isset( $request->order ) ) {
            $order = $request->order;

            if( $order == 'highest' ) {
                $hills->orderBy( 'height', 'desc' );
            } else if( $order == 'other' ) {
                $hills->withCount('trips')->orderBy( 'trips_count', 'desc' );
            } else if( $order == 'newest')  {
                $hills->orderBy( 'id', 'desc' );
            }
        } else {
            $hills->orderBy( 'id', 'desc' );
        }
        

        return $hills->get();
    }

    public function show( $id ) {
        return Hill::with('mountain')->with('trips')->findOrFail( $id );
    }
}
