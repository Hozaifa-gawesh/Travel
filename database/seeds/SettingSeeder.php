<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'site_name' => 'TravelGo',
            'sm_description' => 'TravelGo is an app for tourism.',
            'email_1' => 'info@travelgo.com',
            'phone_1' => '+20101010101000',
        ];
        Setting::create($data);
    }
}
