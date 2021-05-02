<?php

namespace App\Http\Controllers\ApiControllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    

    public function index( Request $request ) {
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

        return $users->get();
    }

    public function show( $id ) {
        return new UserResource( User::findOrFail($id) );
        return User::with('trips')->findOrFail( $id );
    }

    public function update( Request $request ) {

        $request->validate([
            'name'  => 'required|string'
        ]);

        // if( isset( $request->avatar ) ) {

        //     // User had profile picture before, delete that picture
        //     if( $user->avatar_path != '/images/default.png' ) {
        //         $exploded_path = explode( '/', $user->avatar_path );
        //         $file = $exploded_path[ count( $exploded_path ) -1 ];
        //         Storage::delete( '/public/avatars/' . $file );
        //     }
        //     $avatar = $request->file( 'avatar' );
        //     $path = Storage::disk('public')->putFile('avatars', $avatar );

        //     $user->avatar_path = '/storage/' . $path;
            
        // }

        $user = User::findOrFail( $request->id );

        $this->authorize('update', $user);
        
        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
