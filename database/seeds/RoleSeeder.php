<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = array(
            array('role_name' => 'Admin'),
            array('role_name' => 'Student'),
            array('role_name' => 'Teacher')
        );

        DB::table('roles')->insert($roles);
    }
}
