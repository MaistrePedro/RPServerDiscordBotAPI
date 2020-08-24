<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    const NAME = 'name';
    const SHORT = 'short';

    public function jobSkills()
    {
        return $this->hasMany('App\JobSkill');
    }

    public function skillLevels()
    {
        return $this->hasMany('App\SkillLevel');
    }
}
