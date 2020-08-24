<?php

namespace App\Http\Controllers;

use App\Character;
use App\Job;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function getAllCharacters()
    {
        return Character::all();
    }

    public function getOneCharacter(Request $request)
    {
        return Character::where('discord_id', $request->input('discordId'))->first();
    }

    public function createCharacter(Request $request)
    {
        $job = Job::where('short', $request->input('job'));
        $jobId = $job->id;

        $character = new Character();
        $character->discord_id = $request->input('discord_id');
        $character->name = $request->input('name');
        $character->age = $request->input('age');
        $character->gift = $request->input('gift');
        $character->job_id = $jobId;
        $character->save();

        return Controller::SUCCESS;
    }

    public function editCharacter(Request $request)
    {
        $character = Character::where('id', $request->input('id'));
        $field = $request->input('field');
        $value = $request->input('value');
        
        switch ($field) { 
            case Character::NAME:
                $character->name = $value;
                break;
            case Character::AGE:
                $character->age = $value;
                break;
            case Character::GIFT:
                $character->gift = $value;
                break;
            case Character::JOB:
                $character->job_id = $value;
                break;
        }
        $character->save();

        return Controller::SUCCESS;
    }

    public function kill(Request $request)
    {
        $id = $request->input('id');
        Character::destroy($id);

        return Controller::SUCCESS;
    }
}
