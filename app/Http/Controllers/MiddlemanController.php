<?php

namespace App\Http\Controllers;

use App\Mail\SubmissionCreated;
use App\Models\Pokemon;
use App\Models\Submission;
use App\Models\User;
use App\Support\Middleman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MiddlemanController extends Controller
{
    public function home()
    {
        $prices = Middleman::gradingPrices();
        $companies = companies();
        $auctionCompanies = auctionCompanies();

        return Inertia::render('Middleman/Home', [
            'prices' => $prices,
            'companies' => $companies,
            'auctionCompanies' => $auctionCompanies
        ]);
    }

    public function estimator(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'serviceLevel' => 'required',
            'numberOfCards' => 'required',
            'needsCardSavers' => 'required',
            'expedited' => 'required'
        ]);

        $fees = Middleman::gradingFees($request->company, $request->serviceLevel, $request->numberOfCards, $request->needsCardSavers, $request->expedited);

        return response()->json(['fees' => $fees]);
    }

    public function submissionPrintout($subId)
    {
        $sub = Submission::where('sub_id', $subId)->first();
        $pokemon = strtolower(explode('_', $sub->sub_id)[0]);
        $sprite = Pokemon::where('name', $pokemon)->first()->sprite_url;
        $user = User::find($sub->user_id);

        return Inertia::render('Middleman/SubmissionPrintout', [
            'submission' => $sub,
            'pokemonSprite' => $sprite,
            'user' => $user
        ]);
    }

    public function submission($subId) 
    {
        $sub = Submission::where('sub_id', $subId)->first();
        $statuses = statuses();
        $pokemon = strtolower(explode('_', $sub->sub_id)[0]);
        $sprite = Pokemon::where('name', $pokemon)->first()->sprite_url;
        $sub->pokemonSprite = $sprite;

        return response()->json([
            'submission' => $sub,
            'statuses' => $statuses,
            'pokemonSprite' => $sprite
        ]);
    }

    public function submissions()
    {
        $user = Auth::user();
        $statuses = statuses();
        $subs = $user->submissions()->orderBy('id', 'desc')->paginate(5);

        foreach ($subs as $sub) {
            $pokemon = strtolower(explode('_', $sub->sub_id)[0]);
            $sprite = Pokemon::where('name', $pokemon)->first()->sprite_url;
            $sub->pokemonSprite = $sprite;
        }

        return Inertia::render('Middleman/Submissions', [
            'submissions' => $subs,
            'statuses' => $statuses
        ]);
    }

    public function submissionForm()
    {
        $companies = companies();
        $auctionCompanies = auctionCompanies();

        return Inertia::render('Middleman/NewSubmission', [
            'companies' => $companies,
            'auctionCompanies' => $auctionCompanies
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'serviceLevel' => 'required',
            'numberOfCards' => 'required',
            'needsCardSavers' => 'required',
            'acceptedTerms' => 'required',
            'expedited' => 'required',
            'auctionOff' => 'required'
        ]);

        if (Auth::check()) {

            if ($request->acceptedTerms) {

                $user = Auth::user();
                $subId = generateSubId();
                $fees = Middleman::gradingFees($request->company, $request->serviceLevel, $request->numberOfCards, $request->needsCardSavers, $request->expedited);

                $sub = Submission::create([
                    'user_id' => $user->id,
                    'sub_id' => $subId,
                    'company' => $request->company,
                    'service_level' => $request->serviceLevel,
                    'status' => 'created',
                    'number_of_cards' => $request->numberOfCards,
                    'needs_card_savers' => $request->needsCardSavers,
                    'grading_fee' => $fees['gradingFee'],
                    'my_fee' => $fees['myFee'],
                    'card_saver_fee' => $fees['cardSaverFee'],
                    'show_on_channel' => true,
                    'accepted_terms_date' => now(),
                    'note' => $request->note,
                    'expedited' => $request->expedited,
                    'auction_off' => $request->auctionOff,
                    'auction_company' => $request->auctionCompany
                ]);

                Mail::to($user->email)->send(new SubmissionCreated($user->username, $sub));

                return Redirect::route('submission/details', $subId);
            }

            return back()->with('error', 'Something went wrong');
        }

        return back()->with('error', 'Something went wrong');
    }

    public function editSub($id)
    {
        $sub = Submission::findOrFail($id);
        $companies = companies();
        $auctionCompanies = auctionCompanies();

        return Inertia::render('Middleman/Edit', [
            'submission' => $sub,
            'companies' => $companies,
            'auctionCompanies' => $auctionCompanies
        ]);
    }

    public function updateSub(Request $request, $id)
    {
        $request->validate([
            'company' => 'required',
            'service_level' => 'required',
            'number_of_cards' => 'required',
            'needs_card_savers' => 'required',
            'expedited' => 'required'
        ]);

        $sub = Submission::findOrFail($id);

        $fees = Middleman::gradingFees($request->company, $request->service_level, $request->number_of_cards, $request->needs_card_savers, $request->expedited);

        $sub->update([
            'company' => $request->company,
            'service_level' => $request->service_level,
            'number_of_cards' => $request->number_of_cards,
            'needs_card_savers' => $request->needs_card_savers,
            'expedited' => $request->expedited,
            'grading_fee' => $fees['gradingFee'],
            'my_fee' => $fees['myFee'],
            'card_saver_fee' => $fees['cardSaverFee'],
            'auction_off' => $request->auctionOff,
            'auction_company' => $request->auctionOff ? $request->auctionCompany : null
        ]);

        return Redirect::route('middleman/submissions')->with('success', 'Submission updated');
    }

    public function cancelSub($id)
    {
        $sub = Submission::findOrFail($id);
        $sub->delete();

        return back()->with('success', 'Your submission has been canceled');
    }
}
