<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const NAME = 'name';
    const SHORT = 'short';
    
    protected $table = 'job';

    public function skills()
    {
        return $this->hasMany('App\JobSkill');
    }
}
