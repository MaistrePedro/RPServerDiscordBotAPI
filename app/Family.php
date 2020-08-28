<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    const NAME = 'name';
    const MEMBER = 'member';

    protected $table = 'family';

    protected $hidden = [
        'character_id',
        'created_at',
        'updated_at',
    ];

    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function familyMember()
    {
        return $this->belongsTo('App\FamilyMember', 'family_member_id', 'id');
    }
}
