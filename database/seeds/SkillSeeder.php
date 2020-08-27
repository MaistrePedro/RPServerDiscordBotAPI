<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = config('seeds.skills');

        foreach ($skills as $skill) {
            Skill::create([
                'name'  => $skill['name'],
                'short' => $skill['short'],
            ]);
        }
    }
}
