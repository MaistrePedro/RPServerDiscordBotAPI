<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    const LABEL = 'label';
    const SHORT = 'short';
    
    protected $table = 'family_member';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function family()
    {
        return $this->hasMany('App\Family');
    }
}
