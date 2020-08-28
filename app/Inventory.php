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

    protected $table = 'inventory';

    protected $hidden = [
        'character_id',
        'inventory_pieces_id',
        'created_at',
        'updated_at',
    ];

    public function inventoryPiece()
    {
        return $this->belongsTo('App\InventoryPieces', 'inventory_pieces_id', 'id');
    }

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
