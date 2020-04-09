<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $labs = array(
            array('lab_name' => 'NetTech'),
            array('lab_name' => '森口'),
            array('lab_name' => '花田'),
            array('lab_name' => '井関'),
            array('lab_name' => '早稲田')
        );

        DB::table('labs')->insert($labs);
    }
}
