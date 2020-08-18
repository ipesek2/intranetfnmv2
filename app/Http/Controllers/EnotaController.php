<?php

namespace App\Http\Controllers;

use App\Enota;
use Illuminate\Http\Request;

class EnotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enote = Enota::all();
        return view('enota.seznam')->with("enote",$enote);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enota  $enota
     * @return \Illuminate\Http\Response
     */
    public function show(Enota $enota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enota  $enota
     * @return \Illuminate\Http\Response
     */
    public function edit(Enota $enota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enota  $enota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enota $enota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enota  $enota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enota $enota)
    {
        //
    }
}
