<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    public function hills() {
        return $this->hasMany( 'App\Hill' );
    }
}
