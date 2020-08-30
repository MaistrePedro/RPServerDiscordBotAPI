<?php

namespace App\Http\Controllers\Api;

use App\Character;
use App\Job;
use App\Skill;
use App\JobSkill;
use App\SkillLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function getSkills()
    {
        $skills = Skill::paginate(15);

        return response()->json([
            'skills' => $skills,
            'succes' => Controller::SUCCESS,
        ]);
    }

    public function getSkillsByJob(string $short)
    {
        $job = Job::where('short', $short)->first();

        if (!$job) {
            return response()->json([
                'success' => Controller::ERROR,
            ], 404);
        }

        $skillJobs = JobSkill::where('job_id', $job->id)->get();

        if (!$skillJobs) {
            return response()->json([
                'success' => Controller::ERROR,
            ], 404);
        }

        $skills           = [];
        $skills['job']    = $job;
        $skills['skills'] = [];

        foreach ($skillJobs as $skillJob) {
            $skillJob->skill;
            $skills['skills'][] = $skillJob;
        }

        return response()->json([
            'skills' => $skills,
            'success' => Controller::SUCCESS,
        ]);
    }

    public function getSkillsByCharacter(string $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $skillLevels = SkillLevel::where('character_id', $character->id)->get();
        $skills = [];
        $skills['character_name'] = $character->name;
        foreach ($skillLevels as $skillLevel) {
             $skill = $skillLevel->skill;
             $skillLevel->name = $skill->name;
             $skillLevel->short = $skill->short;
            $skills['skills'][] = $skillLevel;
        }
        return response()->json([
            'skills' => $skills
        ]);
    }

    public function createSkill(Request $request)
    {
        $skill = new Skill;
        $skill->name = $request->input('name');
        $skill->short = $request->input('short');
        $skill->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'skill' => $skill
        ]);
    }

    public function addSkillToCharacter(Request $request)
    {
        $skill = Skill::where('short', $request->input('short'))->first();
        if (!$skill) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas la compétence'
            ]);
        }
        $character = Character::where('discord_id', $request->input('character_id'))->first();
        if (!$character) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas le personnage'
            ]);
        }
        $level = $request->input('level');
        $skillLevel = new SkillLevel;
        $skillLevel->character_id = $character->id;
        $skillLevel->skill_id = $skill->id;
        $skillLevel->level = $level;
        $skillLevel->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'skill' => $skill,
            'character' => $character,
            'level' => $skillLevel->level
        ]);
    }

    public function updateSkillLevel(Request $request)
    {
        $skill = Skill::where('short', $request->input('short'))->first();
        if (!$skill) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas cette compétence'
            ]);
        }
        $character = Character::where('discord_id', $request->input('character_id'))->first();
        if (!$character) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas ce personnage'
            ]);
        }
        $skillLevel = SkillLevel::where([
            'character_id' => $character->id,
            'skill_id' => $skill->id
        ])->first();
        if (!$skillLevel) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, il semblerait que ce personnage n\'ait pas appris cette compétence'
            ]);
        }
        $skillLevel->level = $request->input('level');
        $skillLevel->save();
        $skillLevel->skill;
        $skillLevel->character;

        return response()->json([
            'success' => Controller::SUCCESS,
            'skillLevel' => $skillLevel,
        ]);
    }

    public function deleteSkillLevel(int $id)
    {
        SkillLevel::where('id', $id)->first()->delete();
        return response()->json([
            'success' => Controller::SUCCESS
        ]);
    }

    public function addSkillToJob(Request $request)
    {
        $skill = Skill::where('short', $request->input('skill'))->first();
        if (!$skill) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas cette compétence'
            ]);
        }
        $job = Job::where('short', $request->input('job'))->first();
        if (!$job) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas ce métier'
            ]);
        }
        $skillJob = new JobSkill;
        $skillJob->skill_id = $skill->id;
        $skillJob->job_id = $job->id;
        $skillJob->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'skill' => $skill,
            'job' => $job
        ]);
    }

    public function editSkill(Request $request)
    {
        $skill = Skill::where('short', $request->input('short'))->first();
        if (!$skill) {
            return response()->json([
                'success' => Controller::ERROR,
                'message' => 'Désolé, je ne trouve pas cette compétence'
            ]);
        }
        $field = $request->input('field');
        $value = $request->input('value');

        switch ($field) {
            case Skill::NAME:
                $skill->name = $value;
                break;
            case Skill::SHORT:
                $skill->short = $value;
                break;
            default:
                return Controller::ERROR;
                break;
        }
        $skill->save();

        return response()->json([
            'success' => Controller::SUCCESS,
            'skill' => $skill
        ]);
    }

    public function deleteSkillJob(int $id)
    {
        JobSkill::where('id', $id)->first()->delete();

        return response()->json([
            'success' => Controller::SUCCESS
        ]);
    }

    public function deleteSkill(string $short)
    {
        $skill = Skill::where('short', $short)->first();
        if (!$skill) {
            return response()->json([
                'success' => Controller::ERROR,
            ], 404);
        }

        $skill->delete();
        
        return response()->json([
            'success' => Controller::SUCCESS
        ]);
    }
}
