<?php

namespace Database\Seeders;

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
        DB::table('admins')->insert([
            [
                'name' => 'Juan Porter',
                'username' => 'juanporter',
                'gender' => 'male',
                'religion' => 'islam',
                'phone' => '0824207872613',
                'email' => 'juan.porter@example.com',
                'place_of_birth' => 'Wycliff Ave',
                'date_of_birth' => '1973-01-07',
                // 'first_password' => 12345,
                'social' => 'juanporter',
                'password' => bcrypt(12345)
            ],
            [
                'name' => 'Grace Harris',
                'username' => 'graceharris',
                'gender' => 'female',
                'religion' => 'islam',
                'phone' => '0815333113303',
                'email' => 'grace.harris@example.com',
                'place_of_birth' => 'Wycliff Ave',
                'date_of_birth' => '1973-01-07',
                // 'first_password' => 12345,
                'social' => 'graceharris',
                'password' => bcrypt(12345)
            ],
            [
                'name' => 'Bobby Herrera',
                'username' => 'bobbyherrera',
                'gender' => 'male',
                'religion' => 'islam',
                'phone' => '089530093174',
                'email' => 'bobby.herrera@example.com',
                'place_of_birth' => 'Wycliff Ave',
                'date_of_birth' => '1973-01-07',
                // 'first_password' => 12345,
                'social' => 'bobbyherrera',
                'password' => bcrypt(12345)
            ],
        ]);
    }
}
