<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout() {
        Auth::guard('web')->logout();

        return [
            'message'   => 'logged_out'
        ];
    }
}
