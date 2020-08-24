<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    const NAME = 'name';
    const MEMBER = 'member';

    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function familyMember()
    {
        return $this->belongsTo('App\FamilyMember');
    }
}
