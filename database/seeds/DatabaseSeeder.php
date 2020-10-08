<?php

use Database\Seeds\UserSeeder;
use Database\Seeds\ProjectSeeder;
use Database\Seeds\EntrySeeder;
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
            UserSeeder::class,
            ProjectSeeder::class,
            EntrySeeder::class
        ]);

    }
}
