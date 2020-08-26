<?php

namespace App\Http\Controllers\Api;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function getAllJobs()
    {
        return Job::all();
    }

    public function getJobById(int $id)
    {
        return Job::where('id', $id)->first();
    }

    public function getJobByShort(string $short)
    {
        return Job::where('short', $short)->first();
    }

    public function createJob(Request $request)
    {
        $job = new Job;
        $job->name = $request->input('name');
        $job->short = $request->input('short');
        $job->save();
        return Controller::SUCCESS;
    }

    public function editJob(Request $request)
    {
        $job = Job::where('id', $request->input('id'))->first();
        $field = $request->input('field');
        $value = $request->input('value');
        switch ($field) {
            case Job::NAME:
                $job->name = $value;
                break;
            case Job::SHORT:
                $job->short = $value;
                break;
            default:
                return Controller::ERROR;
                break;
        }
        $job->save();

        return Controller::SUCCESS;
    }

    public function deleteJob(int $id)
    {
        Job::where('id', $id)->first()->delete();

        return Controller::SUCCESS;
    }
}
