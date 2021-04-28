<?php

namespace Database\Seeders;

use App\Models\su_Memeber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           su_memebers::class,
           StudentTableSeeder::class,
           UserTableSeeder::class
       ]);
        // User::factory(10)->create();
    }
}
