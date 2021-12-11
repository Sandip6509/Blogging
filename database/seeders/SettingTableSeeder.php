<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
            'site_name' => "Laravel's Blog",
            'address'   => "New Delhi India",
            'contact_number' => '+91 7600244904',
            'contact_email'  => 'Info@laravelblog.com'
        ]);
    }
}
