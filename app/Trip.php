<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    



    public function hill() {
        return $this->belongsTo( 'App\Hill' );
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
