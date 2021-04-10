<?php

namespace App\Http\Controllers\ApiControllers;

use App\Mountain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MountainController extends Controller
{
    
    public function index() {
        return Mountain::all();
    }

}
