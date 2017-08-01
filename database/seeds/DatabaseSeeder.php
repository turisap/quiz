<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $tables = ['quizzes', 'users', 'categories'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(QuizzesSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(LikedTableSeeder::class);
    }


    private function truncate()
    {
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
