<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HillImage extends Model
{
    


    public function hill() {
        return $this->belongsTo( 'App\Hill' );
    }
}
