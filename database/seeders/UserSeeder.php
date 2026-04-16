<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Moderator',
            'email' => 'i@yourgodforever.ru',
            'password' => Hash::make('admin'),
            'role_id' => 1, // ID роли moderator
        ]);

        User::create([
            'name' => 'Simple Reader',
            'email' => 'reader@news.ru',
            'password' => Hash::make('user'),
            'role_id' => 2, // ID роли reader
        ]);
    }
}