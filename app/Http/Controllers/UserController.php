<?php

namespace App\Http\Controllers;

use App\Mail\ContactOmaash;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function profile()
    {
        $userAvatar = Auth::user()->avatar;
        $pokemon = Pokemon::where('sprite_url', $userAvatar)
            ->orWhere('shiny_sprite_url', $userAvatar)
            ->orWhere('official_artwork_url', $userAvatar)
            ->first();

        return Inertia::render('User/Profile', ['pokemon' => $pokemon]);
    }

    public function editProfile()
    {
        return Inertia::render('User/Edit', ['middleware' => false]);
    }

    public function avatarSelection()
    {
        return Inertia::render('User/AvatarSelection');
    }

    public function searchAvatars()
    {
        $query = request()->get('query');

        if ($query) {

            $pokemon = Pokemon::where('name', 'LIKE', "%{$query}%")->orWhere('type', 'like', "%{$query}%")->get();
        } else {

            $pokemon = Pokemon::all();
        }

        return response()->json(['pokemon' => $pokemon]);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required']);

        $user = Auth::user();

        $user->update([
            'avatar' => $request->avatar
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'shipping_type' => 'required',
            'contact_type' => 'required',
            'contact_handle' => 'required',
            'payment_type' => 'required'
        ]);

        $user = Auth::user();

        $user = $user->update([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'shipping_type' => $request->shipping_type,
            'international_address' => $request->international_address,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'contact_type' => $request->contact_type,
            'contact_handle' => $request->contact_handle,
            'payment_type' => $request->payment_type
        ]);

        return Redirect::route('profile')->with('success', 'You successfully updated your profile info!');
    }

    public function contact()
    {
        $pokemonImages = Pokemon::whereIn('name', ['charizard', 'blastoise', 'venusaur'])->get();

        return Inertia::render('Contact', ['pokemon' => $pokemonImages]);
    }

    public function contactOmaash(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'sucker' => 'required',
            'notRobot' => 'required'
        ]);

        if (!$request->notRobot) {
            return back()->with('warning', "Please prove you aren't a robot!");
        }

        $name = trim($request->name);
        $email = trim(strtolower($request->email));
        $message = trim($request->message);
        
        Mail::to('omaashopenings@gmail.com')->send(new ContactOmaash($name, $email, $message));

        return back()->with('success', 'Message has been sent to Omaash.');
    }
}
