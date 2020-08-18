<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Naziv extends Model
{
    protected $fillable = [
        'm_naziv', 'z_naziv', 'kratek_naziv'
    ];

    public function profil(){
        return $this->hasMany(User::class);
    }
}
