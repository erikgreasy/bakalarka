<?php

namespace App\Http\Controllers\ApiControllers;

use App\Hill;
use App\UserHillWishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    
    public function show($id) {
        $hill = Hill::findOrFail($id);
        return $hill->isInWishlist();
    }

    public function index(Request $request) {
        $hills = Auth::user()->wishlists;
        return $hills;
    }

    public function store($id) {
        $hill = Hill::findOrFail($id);
        Auth::user()->wishlists()->sync([$hill->id]);
        return true;
    }

    public function destroy($id) {
        
        return Auth::user()->wishlists()->detach($id);
    }


}
