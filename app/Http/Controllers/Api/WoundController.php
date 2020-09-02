<?php

namespace App\Http\Controllers\Api;

use App\Character;
use App\Wound;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WoundController extends Controller
{
    public function getWounds()
    {
        $results = [
            'wounds' => Wound::all()
        ];
        return response()->json($results);
    }

    public function getWoundsByCharacter(string $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $results = [
            'character_name' => $character->name,
            'wounds' => Wound::where('character_id', $character->id)->get(),
        ];
        return response()->json($results);
    }

    public function hurt(Request $request)
    {
        $character = Character::where('discord_id', $request->input('discord_id'))->first();
        $wound = new Wound;
        $wound->name = $request->input('name');
        $wound->place = $request->input('place');
        $wound->effect = $request->input('effect');
        $wound->character_id = $character->id;
        $wound->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'wound' => $wound
        ]);
    }

    public function editWound(Request $request)
    {
        $wound = Wound::where('id', $request->input('id'))->first();
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case Wound::NAME:
                $wound->name = $value;
            break;
            case Wound::PLACE:
                $wound->place = $value;
            break;
            case Wound::EFFECT:
                $wound->effect = $value;
            break;
            default:
                return Controller::ERROR;
            break;
        }
        $wound->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'wound' => $wound
        ]);
    }

    public function heal(int $id)
    {
        Wound::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }
}
