<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prisotnost extends Model
{
    protected $fillable = [ 'user_id', 'datum', 'tip_prisotnost_id', 'stevilo_ur'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tip(){
        return $this->hasOne(TipPrisotnost::class);
    }


}
