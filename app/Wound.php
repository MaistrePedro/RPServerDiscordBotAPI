<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wound extends Model
{
    const NAME = 'name';
    const PLACE = 'place';
    const EFFECT = 'effect';
    const CHARACTER = 'character';

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
