<?php

namespace App\Http\Controllers\Api;

use App\Character;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Skill;
use App\SkillLevel;

class CharacterController extends Controller
{
    public function getAllCharacters()
    {
        return Character::all();
    }

    public function getOneCharacterById(int $id)
    {
        $character = Character::where('id', $id)->first();
        $character->job;
        $character->skills;
        $character->inventory;
        $character->family;
        $character->convictions;
        $character->wounds;

        // foreach($character->inventory as $object) {
        //     $info = $object->inventoryPiece;
        //     dd($info);
        //     $object->place = $info->label;
        // }

        foreach ($character->skills as $skill) {
            $info         = $skill->skill;
            $skill->id    = $info->id;
            $skill->name  = $info->name;
            $skill->short = $info->short;
        }

        $results = [
            'character' => $character,
        ];

        return response()->json($results);
    }

    public function getOneCharacterByDiscordId($discordId)
    {
        $character = Character::where('discord_id', $discordId)->first();
        $character->job;
        $character->skills;
        $character->inventory;
        $character->family;
        $character->convictions;
        $character->wounds;
        $results = [
            'character' => $character
        ];
        return response()->json([$results]);
    }

    public function createCharacter(Request $request)
    {
        $job = Job::where('short', $request->input('job'))->first();
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
        $character = Character::where('id', $request->input('id'))->first();
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

    public function kill(int $id)
    {
        Character::where('id', $id)->first()->delete();

        return Controller::SUCCESS;
    }
}
