<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(
            [
                AdminSeeder::class,
                SettingTemplateSeeder::class,
                SettingTypeFormSeeder::class,
                SettingFormSeeder::class,
                SettingFormSeeder2::class,
            ]
        );
    }
}
