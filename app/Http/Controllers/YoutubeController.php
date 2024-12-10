<?php

namespace App\Http\Controllers;

use App\Support\YouTube;
use Inertia\Inertia;

class YoutubeController extends Controller
{
    public function videos() 
    {
        $searchQuery = request()->searchQuery;
        $pageToken = request()->pageToken;

        $videos = YouTube::searchOmaashVideos($searchQuery, $pageToken);

        if (isset($videos['error'])) {
            return response('', 409)->header('X-Inertia-Location', 'https://youtube.com/omaash');
        }

        return Inertia::render('Omaash/Videos', ['videos' => $videos]);
    }
}
