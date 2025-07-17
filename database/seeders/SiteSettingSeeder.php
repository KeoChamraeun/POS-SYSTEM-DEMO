<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'site_title'     => 'My Restaurant POS',
            'company_name'   => 'RAEUN IT',
            'address'       => 'Phnom Penh, Cambodia',
            'site_phone'         => '+855 886576689',
            'site_email'         => 'keochamraeun54@gmail.com',
            'currency'      => '$',
            'footer_text'   => '© 2025 RAEUN IT. All rights reserved.',
        ]);
    }
}
