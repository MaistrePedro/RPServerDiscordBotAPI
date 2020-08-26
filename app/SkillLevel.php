<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{

    protected $table = 'skill_level';

    protected $hidden = [
        'character_id',
        'skill_id',
        'created_at',
        'updated_at',
    ];
    
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
