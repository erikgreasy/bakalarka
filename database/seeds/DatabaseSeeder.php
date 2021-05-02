<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // CREATING TEST USER
        User::create([
            'name'              => 'Erik', 
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'email'             => 'erik.masny@gmail.com',
            'remember_token'    => Str::random(10),
        ]);

        // SEEDING DUMMY DATA
        $this->call(MountainSeeder::class);
        $this->call(HillSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TripSeeder::class);



    }
}
