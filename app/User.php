<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profil()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function enota(){
        return $this->hasOne(Enota::class);
    }

    /**
     * Metoda vrne ustrezno obliko naziva glede na spol
     *
     * @return mixed
     */
    public function dobiNaziv(){
        if ($this->profil->spol === 1){
            return $this->profil->naziv->m_naziv;
        }
        return $this->profil->naziv->z_naziv;
    }

    public function jeMoski(){
        if ($this->profil->spol === 1){
            return true;
        }
        return false;
    }
}
