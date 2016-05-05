<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    public function User(){
        return $this->belongsTo('App\User');
    }
}
