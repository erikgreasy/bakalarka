<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    


    public function trip() {
        return $this->belongsto( 'App\Trip' );
    }
}
