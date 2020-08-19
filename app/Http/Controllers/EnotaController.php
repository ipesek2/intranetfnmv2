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
        $enote = Enota::withCount('user')->get();
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
            return redirect('enota/create')
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
        return redirect('/enota');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     */
    public function edit($id)
    {
        $users = UserProfile::select("user_id", DB::raw("CONCAT(user_profiles.priimek,' ',user_profiles.ime) as polno_ime"))->orderBy("priimek","asc")
            ->pluck('polno_ime', 'user_id');

        $enota = Enota::findOrFail($id);
        return view('enota.uredi', ["enota"=> $enota, "users" => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Polje :attribute je obvezno.',
            'unique' => 'Takšna enota že obstaja'
        ];
        $validator = Validator::make($request->all(), [
            'naziv' => ['required',\Illuminate\Validation\Rule::unique('enotas')->ignore($id)],
            "vodja" => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect('enota/create')
                ->withErrors($validator)
                ->withInput();
        }

        $enota = Enota::findOrFail($id);

        $enota->fill($request->all());
        $enota->save();
        $besedilo = "Org. enota {$request->naziv} uspešno shranjena";

        return view('enota.uspeh')->with("besedilo",$besedilo);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enota  $enota
     */
    public function destroy($id)
    {
        $en = Enota::findOrFail($id);
        $en->delete();

        return back();
    }
}
