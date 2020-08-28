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

        return response()->json([
            'character' => $character,
        ]);
    }

    public function createCharacter(Request $request)
    {
        $job_short  = $request->input('job');
        $discord_id = $request->input('discord_id');
        $name       = $request->input('name');
        $age        = $request->input('age');
        $gift       = $request->input('gift');

        $job = Job::where('short', $job_short)->first();

        if (!$job) {
            return response()->json([
                'success' => Controller::ERROR,
                'info'    => 'Le métier demandé n\'existe pas',
            ]);
        }

        if (strlen(trim($name)) < 3) {
            return response()->json([
                'success' => Controller::ERROR,
                'info'    => 'Le nom est trop court (3 caractères minimum)',
            ]);
        }

        if ($age < 1) {
            return response()->json([
                'success' => Controller::ERROR,
                'info'    => 'L\'âge ne peut être inférieur à 1',
            ]);
        }

        if (strlen(trim($gift)) < 3) {
            return response()->json([
                'success' => Controller::ERROR,
                'info'    => 'Le talent est trop court (3 caractères minimum)',
            ]);
        }

        $character = new Character();
        $job_id    = $job->id;

        $character->discord_id = $discord_id;
        $character->name       = trim($name);
        $character->age        = $age;
        $character->gift       = trim($gift);
        $character->job_id     = $job_id;
        $character->save();

        $character->job();
        $character->inventory();
        $character->skills();
        $character->family();
        $character->convictions();
        $character->wounds();

        return response()->json([
            'character' => $character,
            'success'   => Controller::SUCCESS,
        ]);
    }

    public function editCharacter(Request $request)
    {
        $character = Character::where('discord_id', $request->input('id'))->first();

        if (!$character) {
            return response()->json([
                'success' => Controller::ERROR,
                'info'    => 'Personnage introuvable',
            ]);
        }

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
                $job = Job::where('short', $value)->first();
                $character->job_id = $job->id;
                break;
            default:
                return response()->json([
                    'success' => Controller::ERROR,
                    'info'    => 'Aucun champ à modifier',
                ]);
        }
        $character->save();

        return response()->json([
            'success'   => Controller::SUCCESS,
            'character' => $character,
        ]);
    }

    public function killByDiscordId(string $id)
    {
        $character = Character::where('discord_id', $id)->first();
        
        if (!$character) {
            return response()->json([
                'success' => Controller::ERROR,
            ], 404);
        }

        $character->delete();

        return response()->json([
            'success' => Controller::SUCCESS,
        ]);
    }
}
