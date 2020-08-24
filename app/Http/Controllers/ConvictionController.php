<?php

namespace App\Http\Controllers;

use App\Character;
use App\Conviction;
use Illuminate\Http\Request;

class ConvictionController extends Controller
{
    public function getConvictions()
    {
        return Conviction::all();
    }

    public function getConvictionByCharacter(Request $request)
    {
        return Conviction::where('character_id', $request->input('character'));
    }

    public function addConviction(Request $request)
    {
        $character = Character::where('id', $request->input('character'));
        $conviction = new Conviction;
        $conviction->label = $request->input('label');
        $conviction->character_id = $character->id;
        $conviction->save();

        return Controller::SUCCESS;
    }

    public function editConviction(Request $request)
    {
        $conviction = Conviction::where('id', $request->input('id'));
        $conviction->label = $request->input('label');
        $conviction->save();

        return Controller::SUCCESS;
    }

    public function deleteConviction(Request $request)
    {
        $conviction = Conviction::where('id', $request->input('id'));
        Conviction::destroy($conviction->id);

        return Controller::SUCCESS;
    }
}
