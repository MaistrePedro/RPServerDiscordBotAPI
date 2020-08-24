<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    const NAME = 'name';
    const DAMAGE = 'damage';
    const EFFECT = 'effect';
    const QUANTITY = 'quantity';
    const UNIT = 'unit';

    public function inventoryPiece()
    {
        return $this->belongsTo('App\InventoryPieces');
    }
}
