<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
//    use FormAccessible;

    protected $fillable = [
        'ime', 'priimek','user_id', 'naziv_id', 'enota_id', 'spol', 'aktiven', 'izvolitev_do', 'potrjevanje'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function naziv(){
        return $this->belongsTo(Naziv::class);
    }

    public function setIzvolitevDoAttribute($value)
    {
        $this->attributes['izvolitev_do'] = Carbon::createFromFormat('d. n. Y',$value)->format('Y-m-d');
    }

    public function getIzvolitevDoAttribute($value)
    {
        return Carbon::parse($value)->format('d. m. Y');
    }


}
