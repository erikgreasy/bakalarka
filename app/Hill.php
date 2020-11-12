<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hill extends Model
{
    public function mountain() {
        return $this->belongsTo('App\Mountain');
    }
}
