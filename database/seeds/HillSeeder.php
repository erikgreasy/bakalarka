<?php

use App\Hill;
use Illuminate\Database\Seeder;

class HillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Hill::class, 3)->create();
        // Hill::create([
        //     'name'  => 'Krivan',
        //     'height'    => 2400,
        //     'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore veniam incidunt debitis eligendi repellendus reiciendis aperiam aliquam molestiae, nostrum beatae.',
        //     'latitude'  => 49.16254540,
        //     'longitude'    => 19.99991590,
        //     'mountain_id'   => 1,
        // ]);
    }
}
