<?php

namespace App\Http\Controllers\Api;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function getAllJobs()
    {
        $jobs = Job::all();
        return response()->json([
            'jobs' => $jobs
        ]);
    }

    public function getJobById(int $id)
    {
        $jobs = Job::where('id', $id)->first();
        return response()->json([
            'jobs' => $jobs
        ]);
    }

    public function getJobByShort(string $short)
    {
        $jobs = Job::where('short', $short)->first();
        return response()->json([
            'jobs' => $jobs
        ]);
    }

    public function createJob(Request $request)
    {
        $job = new Job;
        $job->name = $request->input('name');
        $job->short = $request->input('short');
        $job->save();
        return response()->json([
            'success' => Controller::SUCCESS,
            'job' => $job
        ]);
    }

    public function editJob(Request $request)
    {
        $job = Job::where('short', $request->input('short'))->first();
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

        return response()->json([
            'success' => Controller::SUCCESS,
            'job' => $job
        ]);
    }

    public function deleteJob(string $short)
    {
        Job::where('short', $short)->first()->delete();

        return response()->json([
            'success' => Controller::SUCCESS
        ]);
    }
}
