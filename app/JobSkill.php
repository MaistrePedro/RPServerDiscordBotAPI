<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{

    protected $hidden = [
        'job_id',
        'skill_id',
        'created_at',
        'updated_at',
    ];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
