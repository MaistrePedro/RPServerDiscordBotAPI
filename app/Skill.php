<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    const NAME = 'name';
    const SHORT = 'short';

    protected $table = 'skill';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function jobSkills()
    {
        return $this->hasMany('App\JobSkill');
    }

    public function skillLevels()
    {
        return $this->hasMany('App\SkillLevel');
    }
}
