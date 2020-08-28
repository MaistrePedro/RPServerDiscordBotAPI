<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const NAME = 'name';
    const SHORT = 'short';
    
    protected $table = 'job';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function skills()
    {
        return $this->hasMany('App\JobSkill', 'job_skill_id');
    }

    public function characters()
    {
        return $this->hasMany('App\Character');
    }
}
