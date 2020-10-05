<?php

namespace App\Http\Controllers;

use App\Enota;
use App\Naziv;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
     */
    public function edit($id)
    {
        $uporabnik = User::findorfail($id);
        $profil = $uporabnik->profil;

        $enote = Enota::all(['id','naziv'])->pluck('naziv','id');
        $naziv = Naziv::all(['id','m_naziv'])->pluck('m_naziv','id');
        $osebe = UserProfile::select("user_id", DB::raw("CONCAT(user_profiles.priimek,' ',user_profiles.ime) as polno_ime"))
            ->where("aktiven", 1)
            ->orderBy("priimek","asc")
            ->pluck('polno_ime', 'user_id');

        return view ('users.uredi', compact('enote', 'naziv', 'osebe', 'uporabnik','profil' ));

    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Polje :attribute je obvezno.',
            'unique' => 'Takšen uporabnik že obstaja'
        ];
        $validator = Validator::make($request->all(), [
            'email' => ['required', \Illuminate\Validation\Rule::unique("users")->ignore($id)],
            'ime' => 'required',
            'priimek' => 'required',
            'naziv' => 'required',
            'enota' => 'required',
            'spol' => 'required',
            'aktiven' => 'required',
            'izvolitev' => 'required',
            'potrjevanje1' => 'required',
//            'izvolitev_do' => Rule::requiredIf(intval($request->naziv_id) > 1)
        ], $messages);

        if ($validator->fails()) {
            return redirect('uporabnik/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $uporabnik = User::findorfail($id);
        $profil = $uporabnik->profil;

        $uporabnik->email = $request->email;
        if (!empty($request->password)){
            $uporabnik->password = bcrypt($request->password);
        }
        $uporabnik->save();

        $data = array(
            'ime' => $request->ime,
            'priimek' => $request->priimek,
            'naziv_id' => $request->naziv,
            'enota_id' => $request->enota,
            'spol' => $request->spol,
            'aktiven' => $request->aktiven,
        );

        $profil->fill($data);

        if ($request->izvolitev === "2"){
            $profil->izvolitev_do = $request->izvolitev_do;
        }
        else {
            $profil->izvolitev_do = null;
        }

        if ($request->naziv === "1"){ //če nima naziva, tudi trajanje izvolitve nima smisla
            $profil->izvolitev_do = null;
        }

        if ($request->potrjevanje1 === "2"){
            $profil->potrjevanje = $request->potrjevanje_oseba;
        }
        else {
            $profil->potrjevanje = 0;
        }

        $profil->save();

        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->orderBy('user_profiles.priimek', 'asc')
            ->get();

        $sporocilo = "Oseba {$profil->ime} {$profil->priimek} je bila uspešno posodobljena";

        return view("users.seznam", compact('users', 'sporocilo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     */
    public function destroy($id)
    {
        $uporabnik = User::findorfail($id);
        $userProfile = $uporabnik->profil;

        if ($userProfile->aktiven === 1){
            $userProfile->aktiven = 2;
            $sporocilo = "Status osebe {$userProfile->ime} {$userProfile->priimek} je bil spremenjen na -- zunanji sodelavec --";
        }
        else {
            $userProfile->aktiven = 1;
            $sporocilo = "Status osebe {$userProfile->ime} {$userProfile->priimek} je bil spremenjen na -- zaposlen na FNM --";
        }

        $userProfile->save();

        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->orderBy('user_profiles.priimek', 'asc')
            ->get();

        return view("users.seznam", compact('users', 'sporocilo'));

    }
}
