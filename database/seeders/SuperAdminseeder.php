<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;

class SuperAdminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "kongjai",
            'phoneNumber' => "+8562022222222",
            'password' => bcrypt("1234"),
            'status' => "not_verify",
            'role_id' => 1,
            
        ]);
    }
}
