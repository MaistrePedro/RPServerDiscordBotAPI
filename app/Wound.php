<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wound extends Model
{
    const NAME = 'name';
    const PLACE = 'place';
    const EFFECT = 'effect';
    const CHARACTER = 'character';

    protected $table = 'wound';

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
