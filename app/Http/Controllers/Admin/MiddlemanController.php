<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SubmissionUpdated;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MiddlemanController extends Controller
{   
    public function submissions()
    {
        $query = request()->get('query');

        if ($query) {

            $submissions = Submission::withTrashed()->where('sub_id', $query)->orWhere('user_id', $query)->orWhere('send_off_date', $query)->paginate(10)->withQueryString();
        } else {

            $submissions = Submission::withTrashed()->orderBy('id', 'desc')->paginate(10);
        }

        return Inertia::render('Admin/Middleman/Submissions', ['submissions' => $submissions]);
    }

    public function editSub($id)
    {
        $sub = Submission::withTrashed()->findOrFail($id);
        $statuses = statuses();
        $companies = companies();
        $auctionCompanies = auctionCompanies();

        return Inertia::render('Admin/Middleman/EditSubmission', [
            'submission' => $sub, 'statuses' => $statuses, 'companies' => $companies, 'auctionCompanies' => $auctionCompanies
        ]);
    }

    public function updateSubmission(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'number_of_cards' => 'required',
            'grading_fee' => 'required',
            'my_fee' => 'required',
            'card_saver_fee' => 'required',
            'paid' => 'required',
            'expedited' => 'required',
            'auction_off' => 'required',
            'company' => 'required',
            'service_level' => 'required'
        ]);

        $submission = Submission::withTrashed()->findOrFail($id);
        $status = $submission->status;
        $user = User::find($submission->user_id);

        $cardSavers = $request->card_saver_fee > 0 ? true : false;
        
        $submission->update([
            'company' => $request->company,
            'service_level' => $request->service_level,
            'status' => $request->status,
            'number_of_cards' => $request->number_of_cards,
            'grading_fee' => $request->grading_fee,
            'my_fee' => $request->my_fee,
            'shipping_fee' => $request->shipping_fee,
            'card_saver_fee' => $request->card_saver_fee,
            'paid' => $request->paid,
            'completed' => $request->completed,
            'completed_date' => $request->completed_date,
            'send_off_date' => $request->send_off_date,
            'tracking_number' => $request->tracking_number,
            'needs_card_savers' => $cardSavers,
            'expedited' => $request->expedited,
            'auction_off' => $request->auction_off,
            'auction_company' => $request->auction_company,
            'sold_amount' => $request->sold_amount,
            'payout' => $request->payout
        ]);

        if ($status != $request->status) {
            Mail::to($user->email)->send(new SubmissionUpdated($user->username, $submission));
        }

        return Redirect::route('admin/middleman/submissions')->with('success', 'Submission updated');
    }
}
