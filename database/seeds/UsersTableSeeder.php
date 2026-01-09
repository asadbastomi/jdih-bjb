<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $overpowerRole = Role::where('nama', 'overpower')->first();
        $superadminRole = Role::where('nama', 'superadmin')->first();
        $administratorRole = Role::where('nama', 'administrator')->first();
        $userRole = Role::where('nama', 'user')->first();

        // name');
        // $table->string('email')->unique();
        // $table->string('username')->nullable();
        // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password')

        $overpower = User::create([
            'name' => 'Over Power',
            'email' => 'edofh@banjarbarukota.go.id',
            'username' => 'overpower',
            'password' => Hash::make('IniPassword123')
        ]);

        $overpower->roles()->attach($overpowerRole);
    }
}
