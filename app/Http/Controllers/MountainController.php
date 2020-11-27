<?php

namespace App\Http\Controllers;

use App\Mountain;
use Illuminate\Http\Request;

class MountainController extends Controller
{
   

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'mountains.index', [
            'mountains' => Mountain::all()
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'mountains.create' );
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required'
        ]);

        $mountain = new Mountain();
        $mountain->name = $request->name;
        $mountain->save();


        return redirect('/mountains');
    }


    /**
     * Display the specified resource.
     */
    public function show(Mountain $mountain)
    {
        return view( 'mountains.show', [
            'mountain'  => $mountain
        ] );
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mountain $mountain)
    {
        return view( 'mountains.edit' );
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mountain $mountain)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mountain $mountain)
    {
        //
    }
}
