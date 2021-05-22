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
        $user = User::create([
            'name'              => 'Tester', 
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'email'             => 'tester@example.com',
            'remember_token'    => Str::random(10),
        ]);

        // SEEDING DATA
        $this->call(MountainSeeder::class);
        $this->call(HillSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TripSeeder::class);

        $user->wishlists()->attach([1, 3]);


    }
}
