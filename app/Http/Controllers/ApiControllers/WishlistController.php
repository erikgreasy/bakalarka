<?php

namespace App\Http\Controllers\ApiControllers;

use App\Hill;
use App\UserHillWishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    


    public function index(Request $request) {
        $hills = Auth::user()->getWishlistHills();
        return $hills;
    }


}
