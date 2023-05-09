<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class UserSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();

		User::insert([
			[
				'email' => 'leonard.vrana4@gmail.com',
				'password' => Hash::make('1234567890'),
                'role' => 0,
				'created_at' => $now, 
				'updated_at' => $now
			]
		]);
	}
}