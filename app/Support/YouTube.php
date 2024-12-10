<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class YouTube
{
    public static function getInfo()
    {
        return [
            'baseUrl' => env('YOUTUBE_URL'),
            'key' => env('YOUTUBE_API_KEY')
        ];
    }

    public static function searchOmaashVideos($query = null, $pageToken = null) 
    {
        $info = self::getInfo();

        $query = $query ? "&q={$query}" : '';
        $pageToken = $pageToken ? "&pageToken={$pageToken}" : '';
        $url = $info['baseUrl'] . "/search?key={$info['key']}&channelId=UC7V5sAmfmiljTmAnW3akk1g&part=snippet&order=date&maxResults=12&type=video{$query}{$pageToken}";

        $response = Http::timeout(120)->get($url);

        return $response->json();
    }
}
