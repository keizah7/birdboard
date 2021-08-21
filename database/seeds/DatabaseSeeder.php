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
        \App\User::factory([
            'email' => 'info@wisecode.lt'
        ])->create();

         $this->call(ProjectSeeder::class);
         $this->call(TaskSeeder::class);
         $this->call(ActivitySeeder::class);
    }
}
