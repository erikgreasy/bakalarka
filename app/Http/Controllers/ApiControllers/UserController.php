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

        $user = User::findOrFail( $request->id );
        $this->authorize('update', $user);

        $request->validate([
            'name'  => 'required|string'
        ]);    


        $avatar = $request->file('avatar');
        if( isset( $avatar ) ) {
            // User had profile picture before, delete that picture
            // if( $user->avatar_path != '/images/default.png' ) {
            //     $exploded_path = explode( '/', $user->avatar_path );
            //     $file = $exploded_path[ count( $exploded_path ) -1 ];
            //     Storage::delete( '/public/avatars/' . $file );
            // }
            $name = 'users/' . uniqid() . '.' . $avatar->extension();
            $avatar->storePubliclyAs('public', $name);
            $user->avatar_path = '/storage/' . $name;
            
        }

        
        $user->name = $request->name;
        $user->save();

        return $user;
    }

    public function topUsers() {
        $most_distance = User::take(1)->withCount(['trips as distance' => function($query) {
                            $query->select(DB::raw('sum(distance)'));
                        }])->orderBy('distance', 'DESC')->get()[0];

        $most_trips = User::take(1)->withCount('trips')->orderBy( 'trips_count', 'desc' )->get()[0];
        $most_time = User::take(1)->withCount(['trips as duration' => function($query) {
                            $query->select(DB::raw('sum(duration)'));
                        }])->orderBy('duration', 'DESC')->get()[0];

        return response()->json([
            'most_distance' => $most_distance,
            'most_trips'    => $most_trips,
            'most_time'     => $most_time,

        ]);
    }
}
