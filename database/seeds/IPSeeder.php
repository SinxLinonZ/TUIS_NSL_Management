<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ips_array = array();

        for ($i=1; $i <= 255; $i++) { 
            $ip = array("address" => "172.22.1.$i");
            array_push($ips_array, $ip);
        }

        DB::table('i_p_s')->insert($ips_array);
    }
}
