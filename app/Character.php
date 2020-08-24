<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    const NAME = 'name';
    const AGE = 'age';
    const GIFT = 'gift';
    const JOB = 'job';

    public function jobs()
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
}
