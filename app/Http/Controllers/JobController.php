<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getAllJobs()
    {
        return Job::all();
    }

    public function getJobById(integer $id)
    {
        return Job::where('id', $id);
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
        $job = Job::where('id', $request->input('id'));
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

    public function deleteJob(integer $id)
    {
        Job::destroy($id);

        return Controller::SUCCESS;
    }
}
