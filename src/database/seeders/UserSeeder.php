<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'email' => 'admin@bookstore.com',
                'email_verified_at' => null,
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('users')->insert(
            [
                'email' => 'customer1@bookstore.com',
                'email_verified_at' => null,
                'password' => Hash::make('customer'),
                'role' => 'customer',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}