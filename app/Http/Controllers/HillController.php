<?php

namespace App\Http\Controllers;

use App\Hill;
use Illuminate\Http\Request;

class HillController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('hills.index', [
            'hills' => Hill::all()
        ]);
    }
}
