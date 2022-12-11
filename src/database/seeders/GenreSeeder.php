<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'genre' => 'Petualangan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'genre' => 'Fantasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'genre' => 'Sejarah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'genre' => 'Motivasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
