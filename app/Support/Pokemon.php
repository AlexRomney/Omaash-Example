<?php 

namespace App\Support;

use Illuminate\Support\Facades\Http;

class Pokemon 
{
    public static function pokemon($id)
    {
        $url = "https://pokeapi.co/api/v2/pokemon/{$id}";

        $response = Http::timeout(120)->get($url);
        
        return $response->json();
    }

    public static function allSets()
    {
        $url = "https://api.pokemontcg.io/v2/sets";

        $response = Http::timeout(120)->get($url);

        return $response['data'];
    }

    public static function set($setId)
    {
        $url = "https://api.pokemontcg.io/v2/sets/{$setId}";

        $response = Http::timeout(120)->get($url);

        return $response['data'];
    }

    public static function setCards($setId)
    {
        $url = "https://api.pokemontcg.io/v2/cards?q=set.id:{$setId}";

        $response = Http::timeout(120)->get($url);

        return $response['data'];
    }

    public static function largeSetCards($setId)
    {
        $url = "https://api.pokemontcg.io/v2/cards?page=2&pageSize=250&q=set.id:{$setId}";

        $response = Http::timeout(120)->get($url);

        return $response['data'];
    }
}