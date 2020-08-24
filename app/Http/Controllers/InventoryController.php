<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventoryPieces;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function getInventories()
    {
        return Inventory::all();
    }

    public function getInventoriesByCharacter(Request $request)
    {
        $character = $request->input('character_id');
        return Inventory::where('character_id', $character);
    }

    public function createInventory(Request $request)
    {
        $piece = InventoryPieces::where('short', $request->input('piece'));
        $pieceId = $piece->id;
        
        $inventory = new Inventory;
        $inventory->name = $request->input('name');
        $inventory->damages = $request->input('damages');
        $inventory->effect = $request->input('effect');
        $inventory->quantity = $request->input('quantity');
        $inventory->unit = $request->input('unit');
        $inventory->inventory_pieces_id = $pieceId;
        $inventory->character_id = $request->input('character_id');
        $inventory->save();

        return Controller::SUCCESS;
    }

    public function editInventory(Request $request)
    {
        $object = Inventory::where('id', $request->input('id'));
    }
}
