<?php

namespace App;

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
}
