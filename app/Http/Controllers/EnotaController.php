<?php

namespace App\Http\Controllers;

use App\Enota;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $users = UserProfile::select("user_id", DB::raw("CONCAT(user_profiles.priimek,' ',user_profiles.ime) as polno_ime"))->orderBy("priimek","asc")
            ->pluck('polno_ime', 'user_id');


        return view('enota.ustvari')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => 'Polje :attribute je obvezno.',
            'unique' => 'Takšna enota že obstaja'
        ];
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|unique:App\Enota',
            "vodja" => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect('enote/create')
                ->withErrors($validator)
                ->withInput();
        }

        $enota = new Enota();

        $enota->fill($request->all());
        $enota->save();
        $besedilo = "Org. enota {$request->naziv} uspešno dodana";

        return view('enota.uspeh')->with("besedilo",$besedilo);
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
