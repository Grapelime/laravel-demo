<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$vsglXvEbRt8bEV78gdBSgu6Bxi/ZYIH64lLULE8WX40QXMMCukjsO',
            'phnumber' => '9645584806',
            'role' => '0'
        ]);
    }
}
