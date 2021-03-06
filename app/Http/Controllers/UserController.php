<?php

namespace App\Http\Controllers;

use App\Hill;
use App\Trip;
use App\User;
use App\UserHillWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
    public function index(Request $request)
    {

        $users = User::take(10);
        $order = $request->order;
        $order_text = 'Predvolené radenie';

        if( isset( $order ) ) {
            switch( $order ) {
                case 'trips':
                    $users->withCount('trips')->orderBy( 'trips_count', 'desc' );
                    $order_text = 'Najviac dobrodružstiev';
                    break;
                case 'distance':
                    $users->withCount(['trips as distance' => function($query) {
                        $query->select(DB::raw('sum(distance)'));
                    }])->orderBy('distance', 'DESC');
                    $order_text = 'Najviac nachodených kilometrov';

                    break;
                case 'time':
                    $users->withCount(['trips as duration' => function($query) {
                        $query->select(DB::raw('sum(duration)'));
                    }])->orderBy('duration', 'DESC');
                    
                    $order_text = 'Najviac času na horách';
                    break;
            }
           
        }


        return view( 'users.index', [
            'users'         => $users->get(),
            'order_text'    => $order_text
        ] );
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $hills = $user->getWishlistHills();
        return view( 'users.show', [
            'user'  => $user,
            'hills' => $hills
        ] );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize( 'update', $user );
        return view( 'users.edit', [
            'user'  => $user
        ] );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize( 'update', $user );


        // print_r( $_POST );
        

        $request->validate([
            'name'  => 'required'
        ]);

        if( isset( $request->avatar ) ) {

            // User had profile picture before, delete that picture
            if( $user->avatar_path != '/images/default.png' ) {
                $exploded_path = explode( '/', $user->avatar_path );
                $file = $exploded_path[ count( $exploded_path ) -1 ];
                Storage::delete( '/public/avatars/' . $file );
            }
            $avatar = $request->file( 'avatar' );
            $path = Storage::disk('public')->putFile('avatars', $avatar );

            $user->avatar_path = '/storage/' . $path;
            
        }

        $user->name = $request->name;
        $user->save();

        return redirect( '/my-profile' );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }



    function filter() {
        return view( 'users.filter' );
    }
    
}
