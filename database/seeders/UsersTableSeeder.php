<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('uniq_name', 'admin')->first();

        $admin = User::create([
            'name' => 'Johnson',
            'last_name' => 'Sardenga',
            'email' => 'serstel@gmail.com',
            'password' => Hash::make('123'),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->roles()->attach($adminRole);
    }
}
