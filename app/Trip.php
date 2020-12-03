<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    
    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'title', 'description', 'user_id', 'hill_id'
    ];



    public function images() {
        return $this->hasMany( 'App\TripImage' );
    }

    public function hill() {
        return $this->belongsTo( 'App\Hill' );
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function logs() {
        return $this->hasMany( 'App\Log' );
    }
}
