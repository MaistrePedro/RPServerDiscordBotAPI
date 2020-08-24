<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    public function family()
    {
        return $this->hasMany('App\Family');
    }
}
