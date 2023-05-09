<?php

namespace Database\Seeders;

use App\Models\Projects\ProjectModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Project extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectModel::insert([
			[
				'project' => 'Project 1',
				'project_url' => 'url',
                'value' => 'anime'
            ],
            [
				'project' => 'Project 2',
				'project_url' => 'url',
                'value' => 'other'
            ]
		]);
    }
}
