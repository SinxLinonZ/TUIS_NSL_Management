<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'lab_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // for test
        DB::table('users')->insert([
            'name' => 'NAME_18101',
            'tuisid' => 'j18101',
            'role_id' => 2,
            'lab_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'NAME_18102',
            'tuisid' => 'j18102',
            'role_id' => 2,
            'lab_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'NAME_18103',
            'tuisid' => 'j18103',
            'role_id' => 2,
            'lab_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Moriguchi',
            'tuisid' => 'ichirou',
            'role_id' => 3,
            'lab_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
