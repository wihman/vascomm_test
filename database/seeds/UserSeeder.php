<?php

use App\User;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'adminones',
            'password' => bcrypt('12345'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'userones',
            'password' => bcrypt('12345'),
        ]);

        $user->assignRole('user');
    }
}
