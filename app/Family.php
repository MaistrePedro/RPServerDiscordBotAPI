<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function familyMember()
    {
        return $this->belongsTo('App\FamilyMember');
    }
}
