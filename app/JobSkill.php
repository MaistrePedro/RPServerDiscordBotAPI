<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
