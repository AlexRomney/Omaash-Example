<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Set;
use App\Support\Pokemon;
use Illuminate\Database\Seeder;

class PokemonCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sets = Pokemon::allSets();

        foreach ($sets as $set) {

            if (!Set::where('set_id', $set['id'])->exists()) {

                switch($set['series']) {

                    case 'Base':
                        $seriesLogo = 'https://images.pokemontcg.io/base1/logo.png';
                    break;

                    case 'Gym':
                        $seriesLogo = 'https://images.pokemontcg.io/gym1/logo.png';
                    break;

                    case 'Neo':
                        $seriesLogo = 'https://images.pokemontcg.io/neo1/logo.png';
                    break;

                    case 'LC':
                        $seriesLogo = 'https://den-media.pokellector.com/logos/Legendary-Collection.logo.112.png';
                    break;

                    case 'E-Card':
                        $seriesLogo = 'https://den-media.pokellector.com/logos/e-Card.logo.108.png';
                    break;

                    case 'EX':
                        $seriesLogo = 'https://images.pokemontcg.io/ex1/logo.png';
                    break;

                    case 'Diamond & Pearl':
                        $seriesLogo = 'https://images.pokemontcg.io/dp1/logo.png';
                    break;

                    case 'Platinum':
                        $seriesLogo = 'https://images.pokemontcg.io/pl1/logo.png';
                    break;

                    case 'HeartGold & SoulSilver':
                        $seriesLogo = 'https://images.pokemontcg.io/hgss1/logo.png';
                    break;

                    case 'Black & White':
                        $seriesLogo = 'https://images.pokemontcg.io/bw1/logo.png';
                    break;

                    case 'XY':
                        $seriesLogo = 'https://images.pokemontcg.io/xy1/logo.png';
                    break;

                    case 'Sun & Moon':
                        $seriesLogo = 'https://images.pokemontcg.io/sm1/logo.png';
                    break;

                    case 'Sword & Shield':
                        $seriesLogo = 'https://images.pokemontcg.io/swsh1/logo.png';
                    break;

                    case 'Scarlet & Violet':
                        $seriesLogo = 'https://images.pokemontcg.io/sv1/logo.png';
                    break;

                    case 'POP':
                        $seriesLogo = 'https://images.pokemontcg.io/pop1/logo.png';
                    break;

                    case 'Other':
                    case 'NP':
                        $seriesLogo = 'https://images.pokemontcg.io/xyp/logo.png';
                    break;
                }

                Set::create([
                    'set_id' => $set['id'],
                    'series' => $set['series'] == 'NP' ? 'Other' : $set['series'],
                    'name' => $set['name'],
                    'release_date' => date('Y-m-d', strtotime($set['releaseDate'])),
                    'release_year' => substr($set['releaseDate'], 0, strpos($set['releaseDate'], '/')),
                    'set_total' => $set['printedTotal'],
                    'secret_rares' => $set['total'] - $set['printedTotal'],
                    'card_total' => $set['total'],
                    'image_symbol' => $set['images']['symbol'],
                    'image_logo' => $set['images']['logo'],
                    'series_logo' => $seriesLogo
                ]);
            }
        }

        $sets = Set::all();

        foreach ($sets as $set) {
            
            if (!Card::where('set_name', $set->name)->exists() || $set->set_id == 'swsh45sv') {

                $cards = collect(Pokemon::setCards($set->set_id))->sortBy('number');

                foreach ($cards as $card) {

                    if (!Card::where('card_id', $card['id'])->exists()) {

                        self::createCard($set, $card);
                    }
                }

                if ($set->set_id == 'sm11' || 
                    $set->set_id == 'sm12' || 
                    $set->set_id == 'swsh8' || 
                    $set->set_id == 'sv1' ||
                    $set->set_id == 'sv2' || 
                    $set->set_id == 'sv3' ||
                    $set->set_id == 'sv4'
                ) {

                    $moreCards = Pokemon::largeSetCards($set->set_id);

                    foreach ($moreCards as $mc) {

                        if (!Card::where('card_id', $mc['id'])->exists()) {

                            self::createCard($set, $mc);
                        }
                    }
                }
            }
        }
    }

    public static function createCard($set, $card)
    {
        $small = $card['images']['small'];

        switch ($small) {

            case "https://images.pokemontcg.io/sv1/257.png":
                $small = $card['images']['large'];
            break;
        }

        Card::create([
            'set_id' => $set->id,
            'card_id' => $card['id'],
            'set_name' => $set->name,
            'name' => $card['name'],
            'number' => $card['number'],
            'types' => $card['types'] ?? null,
            'artist' => $card['artist'] ?? null,
            'rarity' => $card['rarity'] ?? null,
            'image_small' => $small,
            'image_large' => $card['images']['large']
        ]);

        return;
    }
}
