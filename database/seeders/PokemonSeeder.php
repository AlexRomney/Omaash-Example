<?php

namespace Database\Seeders;

use App\Models\Pokemon as Poke;
use App\Support\Pokemon;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pokemonIds = range(1, 1010);

        foreach ($pokemonIds as $id) {

            $exists = Poke::where('id', $id)->exists();

            if (!$exists) {

                $response = Pokemon::pokemon($id);

                Poke::create([
                    'name' => $response['name'],
                    'type' => $response['types'][0]['type']['name'],
                    'sprite_url' => $response['sprites']['front_default'] ?? null,
                    'shiny_sprite_url' => $response['sprites']['front_shiny'] ?? null,
                    'official_artwork_url' => $response['sprites']['other']['official-artwork']['front_default'] ?? null
                ]);
            }
        }
    }
}
