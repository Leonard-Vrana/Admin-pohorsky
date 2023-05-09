<?php

namespace Database\Seeders;

use App\Models\Company\CompanyModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyModel::insert([
            [
                "name" => "admin-url",
                "value" => null,
            ]
        ]);
    }
}
