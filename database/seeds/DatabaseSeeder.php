<?php

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
        // $this->call(UserSeeder::class);
        $this->call(MountainSeeder::class);
        $this->call(HillSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TripSeeder::class);



    }
}
