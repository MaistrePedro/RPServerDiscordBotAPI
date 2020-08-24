<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function skills()
    {
        return $this->hasMany('App\JobSkill');
    }
}
