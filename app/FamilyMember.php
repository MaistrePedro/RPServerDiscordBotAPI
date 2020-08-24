<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    const LABEL = 'label';
    const SHORT = 'short';
    
    public function family()
    {
        return $this->hasMany('App\Family');
    }
}
