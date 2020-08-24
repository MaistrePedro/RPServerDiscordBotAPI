<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
