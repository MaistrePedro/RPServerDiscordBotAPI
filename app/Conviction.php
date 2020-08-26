<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conviction extends Model
{
    protected $table = 'conviction';

    protected $hidden = [
        'character_id',
        'created_at',
        'updated_at',
    ];
    
    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
