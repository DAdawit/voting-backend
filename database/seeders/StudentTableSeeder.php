<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('students')->insert([
                'fullname'=>'stud1',
                'id_number'=>'1000/13',
                'uid'=>1000,
                'password'=>bcrypt(1000)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud2',
                'id_number'=>'1001/13',
                'uid'=>1001,
                'password'=>bcrypt(1001)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud3',
                'id_number'=>'1002/13',
                'uid'=>1002,
                'password'=>bcrypt(1002)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud4',
                'id_number'=>'1003/13',
                'uid'=>1003,
                'password'=>bcrypt(1003)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud5',
                'id_number'=>'1004/13',
                'uid'=>1004,
                'password'=>bcrypt(1004)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud6',
                'id_number'=>'1005/13',
                'uid'=>1005,
                'password'=>bcrypt(1005)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud7',
                'id_number'=>'1006/13',
                'uid'=>1006,
                'password'=>bcrypt(1006)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud8',
                'id_number'=>'1007/13',
                'uid'=>1007,
                'password'=>bcrypt(1007)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud9',
                'id_number'=>'1008/13',
                'uid'=>1008,
                'password'=>bcrypt(1008)
            ]);
            DB::table('students')->insert([
                'fullname'=>'stud10',
                'id_number'=>'1009/13',
                'uid'=>1009,
                'password'=>bcrypt(1009)
             ]);
    }
}
