<?php

namespace App\Http\Controllers\Api;

use App\Wound;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WoundController extends Controller
{
    public function getWounds()
    {
        return Wound::all();
    }

    public function getWoundsByCharacter(int $id)
    {
        return Wound::where('character_id', $id)->get();
    }

    public function hurt(Request $request)
    {
        $character = Character::where('discord_id', $request->input('discord_id'));
        $wound = new Wound;
        $wound->name = $request->input('name');
        $wound->place = $request->input('place');
        $wound->effect = $request->input('effect');
        $wound->character_id = $character->id;
        $wound->save();

        return Controller::SUCCESS;
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

        return Controller::SUCCESS;
    }

    public function heal(int $id)
    {
        Wound::destroy($id);
        return Controller::SUCCESS;
    }
}
