<?php

namespace App\Console\Commands;

use App\Mail\SubmissionUpdated;
use App\Models\Submission;
use App\Models\User;
use App\Support\Shippo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'middleman:checktracking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks tracking number of shipped submissions to see if they are delivered.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subs = Submission::where('status', 'shipped')->whereNotNull('tracking_number')->get();

        foreach ($subs as $sub) {

            $checker = Shippo::trackPackage($sub->tracking_number);

            if (isset($checker['tracking_status'])) {

                $status = $checker['tracking_status']['status'];

                if ($status == 'DELIVERED') {

                    $user = User::find($sub->user_id);
                    
                    $sub->update([
                        'completed' => true,
                        'completed_date' => now(),
                        'status' => 'complete'
                    ]);

                    Mail::to($user->email)->send(new SubmissionUpdated($user->username, $sub));
                }
            }
        }
    }
}
