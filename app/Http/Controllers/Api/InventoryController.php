<?php

namespace App\Http\Controllers\Api;

use App\Inventory;
use App\InventoryPieces;
use App\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function getInventories()
    {
        return Inventory::paginate(20);
    }

    public function getInventoriesByCharacter(int $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $result = [
            'character_name' => $character->name,
            'inventory' => Inventory::where('character_id', $character->id)->get()
        ];
        return response()->json([$result]);
    }

    public function createInventory(Request $request)
    {
        $piece = InventoryPieces::where('short', $request->input('piece'))->first();
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
        $object = Inventory::where('id', $request->input('id'))->first();
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case Inventory::NAME:
                $object->name = $value;
                break;
            case Inventory::DAMAGE:
                $object->damages = $value;
                break;
            case Inventory::EFFECT:
                $object->effect = $value;
                break;
            case Inventory::QUANTITY:
                if ($value === 0) {
                    Inventory::destroy($object->id);
                    break;
                } 
                else {
                    $object->quantity = $value;
                    break;
                }
            default:
                return Controller::ERROR;
                break;
        }
        $object->save();
        return Controller::SUCCESS;
    }

    public function destroy(integer $id)
    {
        Inventory::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }

    public function getInventoryPieces()
    {
        return InventoryPieces::all();
    }

    public function getOneInventoryPiece(int $id)
    {
        return InventoryPieces::where('id', $id)->first();
    }

    public function getOneInventoryPieceByShort(string $short)
    {
        return InventoryPieces::where('short', $short)->first();
    }

    public function createInventoryPiece(Request $request)
    {
        $piece = new InventoryPieces;
        $piece->label = $request->input('label');
        $piece->short = $request->input('short');
        $piece->save();

        return Controller::SUCCESS;
    }

    public function editInventoryPiece(Request $request)
    {
        $piece = InventoryPieces::where('short', $request->input('short'))->first();
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case InventoryPieces::LABEL:
                $piece->label = $value;
            break;
            case InventoryPieces::SHORT:
                $piece->short = $value;
            break;
            default: 
                return Controller::ERROR;
            break;
        }
        $piece->save();
        return Controller::SUCCESS;
    }

    public function deleteInventoryPiece(integer $id)
    {
        InventoryPieces::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }
}
