<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Omaash',
            'email' => 'omaashopenings@gmail.com',
            'password' => bcrypt('password'),
            'shipping_type' => 'states',
            'first_name' => 'Alex',
            'last_name' => 'Romney',
            'address' => 'PO BOX 580',
            'city' => 'Vineyard',
            'state' => 'UT',
            'zip' => 84059,
            'contact_type' => 'instagram',
            'contact_handle' => '@omaash',
            'payment_type' => 'venmo',
        ]);

        User::create([
            'username' => 'Broncos or Die!',
            'email' => 'skylercrane7@gmail.com',
            'password' => bcrypt('password'),
            'shipping_type' => 'states',
            'first_name' => 'Skyler',
            'last_name' => 'Crane',
            'address' => '1234 Test Dr',
            'city' => 'Spanish Fork',
            'state' => 'UT',
            'zip' => 84059,
            'contact_type' => 'email',
            'contact_handle' => 'skylercrane7@gmail.com',
            'payment_type' => 'venmo',
        ]);
    }
}
