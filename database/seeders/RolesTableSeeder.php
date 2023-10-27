<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Администратор', 'uniq_name' => 'admin']);
        Role::create(['name' => 'Модератор', 'uniq_name' => 'moder']);
    }
}
