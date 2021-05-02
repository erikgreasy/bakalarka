<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function trips() {
        return $this->hasMany( 'App\Trip' );
    }

    public function wishlists() {
        return $this->hasMany( 'App\UserHillWishlist' );
    }

    public function isInWishlist( $hill_id ) {
        if( ! $this->getUserwishlist( $hill_id )->isEmpty() ) {
            return true;
        }
        return false;
    }

    public function getUserwishlist( $hill_id ) {
        $userwishlist = UserHillWishlist::where( 'hill_id', $hill_id )->where( 'user_id', $this->id )->get();
        return $userwishlist;
    }

    public function getWishlistHills() {
        $wishlists = UserHillWishlist::where( 'user_id', $this->id )->orderBy('id','desc')->get();
        $hills = [];
        foreach( $wishlists as $wish ) {
            $hills[] = $wish->hill;
        }

        return $hills;
    }

    public function timeOnHills() {
        return $this->trips->sum('duration');
    }

    public function walkedDistance() {
        return $this->trips->sum('distance');

    }

}
