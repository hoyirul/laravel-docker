<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'user_id' => 1,
                'name' => 'Mochammad Hairullah',
                'phone_number' => '08765746574',
                'gender' => 'L',
                'address' => 'Jl. Rengganis no 19, Desa Kembang, Bondowoso',
                'zip_code' => 68219,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
