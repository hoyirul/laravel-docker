<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert(
            [
                'user_id' => 2,
                'name' => 'Elvira Sania',
                'phone_number' => '08435746574',
                'gender' => 'P',
                'address' => 'Jl. Raya Grogol no 13, Desa Asem, Kediri',
                'zip_code' => 68329,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
