<?php

namespace App\Console\Commands;

use App\Mail\SubmissionReminder as MailSubmissionReminder;
use App\Models\Submission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SubmissionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'submission:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all the created submissions and sends a reminder to submit email.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $twoWeeks = now()->subWeeks(2);

        $submissions = Submission::with('user')->where('status', 'created')->where('created_at', '<=', $twoWeeks)->get();

        foreach ($submissions as $sub) {

            Mail::to($sub->user->email)->send(new MailSubmissionReminder($sub));
        }
    }
}
