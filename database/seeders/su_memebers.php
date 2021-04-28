<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class su_memebers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('su__memebers')->insert([
           'fullname'=>'zed daniel',
           'college'=>'cci',
           'department' =>'software',
            'sex'=>'female',
            'id_number'=>'0678/09',
            'suid'=>1001
        ]);
        DB::table('su__memebers')->insert([
            'fullname'=>'Rediet behailu',
            'college'=>'cci',
            'department'=>'system',
            'sex'=>'female',
            'id_number'=>'0663/09',
            'suid'=>1002
        ]);
        DB::table('su__memebers')->insert([
            'fullname'=>'yeshi degu',
            'college'=>'cci',
            'department'=>'computer science',
            'sex'=>'female',
            'id_number'=>'0684/09',
            'suid'=>1003
        ]);   DB::table('su__memebers')->insert([
            'fullname'=>'haymanot debash',
            'college'=>'computing',
            'department'=>'CS',
            'sex'=>'female',
            'id_number'=>'0681/09',
            'suid'=>1004
       ]);
        DB::table('su__memebers')->insert([
            'fullname'=>'ayantu shegut',
            'college'=>'CCI',
            'department'=>'SWE',
            'sex'=>'female',
            'id_number'=>'0680/09',
            'suid'=>1005
      ]);

    }
}
