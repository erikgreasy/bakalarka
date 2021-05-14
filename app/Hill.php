<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Hill extends Model
{
    public function mountain() {
        return $this->belongsTo('App\Mountain');
    }

    public function images() {
        return $this->hasMany('App\HillImage');
    }

    public function trips() {
        return $this->hasMany( 'App\Trip' )->orderBy('id', 'DESC');
    }

    public function isInWishlist() {
        $hills = Auth::user()->wishlists;
        return $hills->contains($this);
    }

    public function wishlisters() {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function favoriteOrder() {
        $hills = Hill::withCount('trips')->orderBy( 'trips_count', 'desc' )->get();

        return $hills->search(function($hill) {
            return $hill->id == $this->id;
        });
    }
}
