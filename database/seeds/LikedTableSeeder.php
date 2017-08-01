<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Liked::class, 500)->create();
    }
}
