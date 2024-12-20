<?php

namespace Database\Seeders;

# Package
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

# Models
use App\Models\Auth\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::create([
			'name' => 'Admin',
			'level' => 'admin',
			'username' => 'admin',
			'password' => bcrypt('admin'),
			// 'password' => bcrypt('78aBUadl63cZ'),
		]);
		User::create([
			'name' => 'Kasir',
			'level' => 'kasir',
			'username' => 'kasir',
			'password' => bcrypt('kasir'),
		]);
	}
}
