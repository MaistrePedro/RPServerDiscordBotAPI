<?php

use App\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = config('seeds.jobs');

        foreach ($jobs as $job) {
            Job::create([
                'name'  => $job['name'],
                'short' => $job['short'],
            ]);
        }
    }
}
