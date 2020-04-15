<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
}
