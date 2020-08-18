<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
//    use FormAccessible;

    protected $fillable = [
        'ime', 'priimek','naziv_id', 'enota_id', 'spol', 'aktiven', 'izvolitev_do', 'potrjevanje'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function naziv(){
        return $this->belongsTo(Naziv::class);
    }


}
