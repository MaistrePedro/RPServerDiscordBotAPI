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

    public function getConvictionByCharacter(integer $id)
    {
        return Conviction::where('character_id', $id);
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

    public function deleteConviction(integer $id)
    {
        Conviction::destroy($id);

        return Controller::SUCCESS;
    }
}
