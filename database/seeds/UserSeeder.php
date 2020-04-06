<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'tuisid' => 'administrator',
            'password' => Hash::make('Administrator'),
            'role_id' => 1,
            'lab_id' => 1
        ]);
    }
}
