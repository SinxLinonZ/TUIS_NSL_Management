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
            array('lab_name' => 'Moriguchi'),
            array('lab_name' => 'Hanada'),
            array('lab_name' => 'Iseki'),
            array('lab_name' => 'Waseda')
        );

        DB::table('labs')->insert($labs);
    }
}
