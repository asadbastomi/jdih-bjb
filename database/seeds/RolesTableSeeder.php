<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['nama' => 'overpower']);
        Role::create(['nama' => 'superadmin']);
        Role::create(['nama' => 'administrator']);
        Role::create(['nama' => 'user']);
    }
}
