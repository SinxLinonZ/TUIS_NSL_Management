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
            array('role_name' => '管理者'),
            array('role_name' => '学生'),
            array('role_name' => '先生'),
            array('role_name' => 'ゼミ長')
        );

        DB::table('roles')->insert($roles);
    }
}
