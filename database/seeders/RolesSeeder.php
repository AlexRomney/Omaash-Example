<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        $users = User::all();

        foreach ($users as $u) {

            $u->assignRole('user');
            $u->assignRole('admin');
        }
    }
}
