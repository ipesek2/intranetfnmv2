<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enota extends Model
{
    protected $fillable = [ 'naziv', 'vodja', 'namestnik'];

    public function user(){
        return $this->hasMany(UserProfile::class);
    }


    public function dobiPredstojnikIme(){
        $predstojnik = User::all()->find($this->vodja);
        return $predstojnik->profil->ime . " " . $predstojnik->profil->priimek;
    }

    public function dobiNamestnikIme(){
        if (!is_null($this->namestnik)) {
            $predstojnik = User::all()->find($this->namestnik);
            return $predstojnik->profil->ime . " " . $predstojnik->profil->priimek;
        }
        return "";
    }
}
