<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHillWishlist extends Model
{
    //
    // public $timestamps = false;


    public function hill() {
        return $this->belongsTo( 'App\Hill' )->with('mountain');
    }
}
