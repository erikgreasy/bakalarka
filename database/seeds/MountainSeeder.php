<?php

use App\Mountain;
use Illuminate\Database\Seeder;

class MountainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Mountain::class, 10)->create();
        $mountains = [
            'Tatry',
            'Nízke Tatry',
            'Malá Fatra',
            'Chočské vrchy',
        ];


        foreach( $mountains as $mountain ) {
            Mountain::create([
                'name'  => $mountain,
            ]);
        }

    }
}
