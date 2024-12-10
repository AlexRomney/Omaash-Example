<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PokemonCardsSeeder::class);
        $this->call(PokemonSeeder::class);
        $this->call(SubmissionSeeder::class);
    }
}
