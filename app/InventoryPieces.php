<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryPieces extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
}
