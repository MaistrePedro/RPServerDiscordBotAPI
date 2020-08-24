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
    const INVENTORY_PIECE = 'inventory_piece';
    const CHARACTER_ID = 'character_id';

    public function inventoryPiece()
    {
        return $this->belongsTo('App\InventoryPieces');
    }
}
