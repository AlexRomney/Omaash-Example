<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Pokemon;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CardController extends Controller
{
    public function sets()
    {
        $query = request()->get('query');

        if ($query) {

            $series = Set::whereNotIn('set_id', ['swsh12pt5gg', 'swsh12tg', 'swsh11tg', 'swsh10tg', 'swsh9tg', 'cel25c', 'sma', 'swsh45sv'])
                ->orderBy('release_date', 'desc')
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('series', 'LIKE', "%{$query}%")
                ->get()
                ->groupBy('series');

        } else {

            $series = Set::whereNotIn('set_id', ['swsh12pt5gg', 'swsh12tg', 'swsh11tg', 'swsh10tg', 'swsh9tg', 'cel25c', 'sma', 'swsh45sv'])
                ->orderBy('release_date', 'desc')
                ->get()
                ->groupBy('series');
        }

        $navSeries = Set::orderBy('release_date', 'desc')->select('id', 'series', 'series_logo')->get()->unique('series');

        return Inertia::render('Cards/Sets', ['series' => $series, 'navSeries' => $navSeries]);
    }

    public function set($id)
    {     
        $set = Set::find($id);

        $cards = Card::getCards($set);

        return Inertia::render('Cards/Set', ['cards' => $cards]);
    }

    public function cards()
    {
        $query = request()->get('query');

        $card = Card::query();

        if ($query) {
            
            if ($query == 'mew') {

                $pokemonCards = $card->where('name', 'LIKE', "%{$query}%")->whereNot('name', 'LIKE', '%mewtwo%')->where('name', 'NOT LIKE', 'mewtwo')->paginate(36)->withQueryString();

            } else {

                $pokemonCards = $card->where('name', 'LIKE', "%{$query}%")->orWhere('artist', 'LIKE', "%{$query}%")->paginate(36)->withQueryString();
            }

        } elseif (Auth::check()) {

            $avatar = Auth::user()->avatar;

            $explode = explode('/', $avatar);
            $end = last($explode);
            $pokemonId = substr($end, 0, strpos($end, '.'));

            $pokemon = Pokemon::find($pokemonId);

            if ($pokemon->name == 'mew') {

                $pokemonCards = $card->where('name', 'LIKE', "{$pokemon->name}%")->whereNot('name', 'LIKE', '%mewtwo%')->paginate(36)->withQueryString();

            } else {

                $pokemonCards = $card->where('name', 'LIKE', "{$pokemon->name}%")->paginate(36)->withQueryString();
            }

        } else {

            $pokemonCards = $card->where('name', 'LIKE', '%pikachu%')->paginate(36)->withQueryString();
        }

        $topPokemon = [
            [
                'name' => 'Charizard',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png',
            ],
            [
                'name' => 'Lugia',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/249.png',
            ],
            [
                'name' => 'Blastoise',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png',
            ],
            [
                'name' => 'Dragonite',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/149.png',
            ],
            [
                'name' => 'Rayquaza',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/384.png',
            ],
            [
                'name' => 'Mewtwo',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png',
            ],
            [
                'name' => 'Mew',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/151.png',
            ],
            [
                'name' => 'Greninja',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/658.png',
            ],
            [
                'name' => 'Typhlosion',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/157.png',
            ],
            [
                'name' => 'Arcanine',
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/59.png',
            ],
        ];

        return Inertia::render('Cards/Index', ['cards' => $pokemonCards, 'topPokemon' => $topPokemon]);
    }
}
