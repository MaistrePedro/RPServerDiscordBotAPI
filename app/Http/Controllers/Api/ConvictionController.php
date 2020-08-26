<?php

namespace App\Http\Controllers\Api;

use App\Character;
use App\Conviction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvictionController extends Controller
{
    public function getConvictions()
    {
        return Conviction::all();
    }

    public function getConvictionByCharacter(string $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $results = [
            'convictions' => Conviction::where('character_id', $character->id)->get()
        ];
        return response()->json($results);
    }

    public function addConviction(Request $request)
    {
        $character = Character::where('discord_id', $request->input('character'))->first();
        $conviction = new Conviction;
        $conviction->label = $request->input('label');
        $conviction->character_id = $character->id;
        $conviction->save();

        return Controller::SUCCESS;
    }

    public function editConviction(Request $request)
    {
        $conviction = Conviction::where('id', $request->input('id'))->first();
        $conviction->label = $request->input('label');
        $conviction->save();

        return Controller::SUCCESS;
    }

    public function deleteConviction(int $id)
    {
        Conviction::destroy($id);

        return Controller::SUCCESS;
    }
}
