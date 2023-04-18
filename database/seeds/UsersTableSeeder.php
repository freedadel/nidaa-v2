<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Freed Adel',
            'img' => 'profile.jpg',
            'email' => 'freed.adel@gmail.com',
            'password' => Hash::make('password'),
            'user_id' => 0,
            'admin' => 1
        ]);
    }
}
