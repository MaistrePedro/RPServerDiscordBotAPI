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
        $job = Job::where('short', $short);
        $skillJobs = JobSkill::where('job_id', $job->id); 
        $skills = [];
        $skills['job'] = $job;
        foreach ($skillJobs as $skill) {
            $skills[] = Skill::where('id', $skill->skill_id);
        }
        return $skills;
    }

    public function getSkillsByCharacter(integer $id)
    {
        $character = Character::where('id', $id)->first();
        $skillLevels = SkillLevel::where('character_id', $character->id);
        $skills = [];
        $skills['character'] = $character;
        foreach ($skillLevels as $skill) {
            $skills[] = Skill::where('id', $skill->skill_id);
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
        $skill = Skill::where('id', $request->input('skill'));
        $character = Character::where('id', $request->input('character'));
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
        $skillLevel = SkillLevel::where('id', $request->input('skill_level'));
        $skillLevel->level = $request->input('level');
        $skillLevel->save();

        return Controller::SUCCESS;
    }

    public function deleteSkillLevel(integer $id)
    {
        SkillLevel::destroy($id);

        return Controller::SUCCESS;
    }

    public function addSkillToJob(Request $request)
    {
        $skill = Skill::where('id', $request->input('skill'));
        $job = Job::where('id', $request->input('job'));
        $skillJob = new JobSkill;
        $skillJob->skill_id = $skill->id;
        $skillJob->job_skill = $job->id;
        $skillJob->save();

        return Controller::SUCCESS;
    }

    public function deleteSkillJob(integer $id)
    {
        SkillJob::destroy($id);

        return Controller::SUCCESS;
    }

    public function editSkill(Request $request)
    {
        $skill = Skill::where('id', $request->input('skill'));
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

    public function deleteSkill(integer $id)
    {
        Skill::destroy($id);

        return Controller::SUCCESS;
    }
}
