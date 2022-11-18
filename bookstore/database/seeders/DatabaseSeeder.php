<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.mail',
            'password' => Hash::make('123'),
            'created_at' => $time->addSeconds(1),
            'updated_at' => $time,
            'role' => 10
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@test.mail',
            'password' => Hash::make('123'),
            'created_at' => $time->addSeconds(1),
            'updated_at' => $time,
            'role' => 1
        ]);
    }
}
