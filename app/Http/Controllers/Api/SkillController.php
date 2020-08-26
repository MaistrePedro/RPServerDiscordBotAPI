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
        return Skill::all();
    }

    public function getSkillsByJob(string $short)
    {
        $job = Job::where('short', $short)->first();
        $skillJobs = JobSkill::where('job_id', $job->id)->get(); 
        $skills = [];
        $skills['job'] = $job;
        $skills['skills'] = [];
        foreach ($skillJobs as $skillJob) {
            $skillJob->skill;
            $skills['skills'][] = $skillJob;
        }
        return $skills;
    }

    public function getSkillsByCharacter(string $discord_id)
    {
        $character = Character::where('discord_id', $discord_id)->first();
        $skillLevels = SkillLevel::where('character_id', $character->id)->get();
        $skills = [];
        $skills['character_name'] = $character->name;
        foreach ($skillLevels as $skillLevel) {
            $skillLevel->skill;
            $skills['skills'][] = $skillLevel; 
        }
        return $skills;
    }

    public function createSkill(Request $request)
    {
        $skill = new Skill;
        $skill->name = $request->input('name');
        $skill->short = $request->input('short');
        $skill->save();

        return Controller::SUCCESS;
    }

    public function addSkillToCharacter(Request $request)
    {
        $skill = Skill::where('short', $request->input('short'))->first();
        $character = Character::where('id', $request->input('character_id'))->first();
        $level = $request->input('level');
        $skillLevel = new SkillLevel;
        $skillLevel->character_id = $character->id;
        $skillLevel->skill_id = $skill->id;
        $skillLevel->level = $level;
        $skillLevel->save();

        return Controller::SUCCESS;
    }

    public function updateSkillLevel(Request $request)
    {
        $skillLevel = SkillLevel::where([
            'short' => $request->input('short'),
            'character_id' => $request->input('character_id'),
        ])->first();
        $skillLevel->level = $request->input('level');
        $skillLevel->save();

        return Controller::SUCCESS;
    }

    public function deleteSkillLevel(int $id)
    {
        SkillLevel::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }

    public function addSkillToJob(Request $request)
    {
        $skill = Skill::where('short', $request->input('skill'))->first();
        $job = Job::where('short', $request->input('job'))->first();
        $skillJob = new JobSkill;
        $skillJob->skill_id = $skill->id;
        $skillJob->job_id = $job->id;
        $skillJob->save();

        return Controller::SUCCESS;
    }

    public function editSkill(Request $request)
    {
        $skill = Skill::where('short', $request->input('short'))->first();
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

        return Controller::SUCCESS;
    }

    public function deleteSkillJob(int $id)
    {
        SkillJob::destroy($id);

        return Controller::SUCCESS;
    }

    public function deleteSkill(int $id)
    {
        Skill::where('id', $id)->first()->delete();
        return Controller::SUCCESS;
    }
}
