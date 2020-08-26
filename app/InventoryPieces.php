<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryPieces extends Model
{
    const LABEL = 'label';
    const SHORT = 'short';
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
}
