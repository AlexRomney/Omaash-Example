<?php

namespace Database\Seeders;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = [1, 2];

        foreach ($userIds as $userId) {

            Submission::create([
                'user_id' => $userId,
                'sub_id' => generateSubId(),
                'company' => 'PSA',
                'service_level' => 'regular',
                'status' => 'grading',
                'number_of_cards' => 10,
                'needs_card_savers' => false,
                'grading_fee' => 1000,
                'my_fee' => 30,
                'shipping_fee' => 45,
                'card_saver_fee' => 0,
                'paid' => true,
                'show_on_channel' => true,
                'completed' => false,
                'completed_date' => null,
                'send_off_date' => '2022-01-16',
                'tracking_number' => null,
                'accepted_terms_date' => '2022-01-10',
                'note' => 'Omaash Nation forever babyyyyy!'
            ]);
        }
    }
}
