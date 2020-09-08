<?php

namespace App\Http\Controllers;

use App\Enota;
use App\Naziv;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->orderBy('user_profiles.priimek', 'asc')
            ->get();

        $sporocilo = "";

        return view("users.seznam", compact('users', 'sporocilo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enote = Enota::all(['id','naziv'])->pluck('naziv','id');
        $naziv = Naziv::all(['id','m_naziv'])->pluck('m_naziv','id');
        $osebe = UserProfile::select("user_id", DB::raw("CONCAT(user_profiles.priimek,' ',user_profiles.ime) as polno_ime"))
            ->where("aktiven", 1)
            ->orderBy("priimek","asc")
            ->pluck('polno_ime', 'user_id');
        return view("users.ustvari", compact('enote', 'naziv', 'osebe'));
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
            'unique' => 'Takšen uporabnik že obstaja'
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:App\User',
            "password" => 'required',
            'ime' => 'required',
            'priimek' => 'required',
            'naziv' => 'required',
            'enota' => 'required',
            'spol' => 'required',
            'aktiven' => 'required',
            'izvolitev' => 'required',
            'potrjevanje' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect('uporabnik/create')
                ->withErrors($validator)
                ->withInput();
        }

        // shranimo uporabnika
        $uporabnik = new User();
        $uporabnik->email = $request->email;
        $uporabnik->password = bcrypt($request->password);
        $uporabnik->save();

        //sedaj pa še profil
        $profil = new UserProfile();
        $data = array(
            'ime' => $request->ime,
            'priimek' => $request->priimek,
            'user_id' => $uporabnik->id,
            'naziv_id' => $request->naziv,
            'enota_id' => $request->enota,
            'spol' => $request->spol,
            'aktiven' => $request->aktiven,
        );
        $profil->fill($data);
        if ($request->izvolitev === "2"){
            $profil->izvolitev_do = $request->izvolitev_do;
        }

        $profil->potrjevanje = 0;
        if ($request->potrjevanje === "2"){
            $profil->potrjevanje = $request->potrjevanje_oseba;
        }

        $profil->save();

        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->orderBy('user_profiles.priimek', 'asc')
            ->get();


        $sporocilo = "Oseba {$profil->ime} {$profil->priimek} je bil uspešno ustvarjen";
        if ($profil->spol === '2'){
            $sporocilo = "Oseba {$profil->ime} {$profil->priimek} je bila uspešno ustvarjena";
        }

        return view("users.seznam", compact('users', 'sporocilo'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {

    }
}
