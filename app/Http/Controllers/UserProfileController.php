<?php

namespace App\Http\Controllers;

use App\Enota;
use App\Naziv;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view("users.seznam", compact('users'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
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
        //
    }
}
