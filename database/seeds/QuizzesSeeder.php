<?php

use Illuminate\Database\Seeder;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Quiz::class, 40)->create();
    }
}
