<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    const NAME = 'name';
    const AGE = 'age';
    const GIFT = 'gift';
    const JOB = 'job';

    protected $hidden = [
        'job_id',
        'created_at',
        'updated_at',
    ];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }

    public function skills()
    {
        return $this->hasMany('App\SkillLevel');
    }

    public function family()
    {
        return $this->hasMany('App\Family');
    }

    public function convictions()
    {
        return $this->hasMany('App\Conviction');
    }

    public function wounds()
    {
        return $this->hasMany('App\Wound');
    }
}
