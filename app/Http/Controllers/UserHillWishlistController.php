<?php

namespace App\Http\Controllers;

use App\UserHillWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHillWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wish = new UserHillWishlist();

        $wish->user_id = Auth::user()->id;
        $wish->hill_id = $request->hill;
        $wish->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserHillWishlist  $userHillWishlist
     * @return \Illuminate\Http\Response
     */
    public function show(UserHillWishlist $userHillWishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserHillWishlist  $userHillWishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(UserHillWishlist $userHillWishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserHillWishlist  $userHillWishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserHillWishlist $userHillWishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserHillWishlist  $userHillWishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $wish = UserHillWishlist::find( $id );
        // $userHillWishlist->delete();
        $wish->delete();
        return back();
    }
}
