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
            'site_name'     => 'My Restaurant POS',
            'site_logo'          => 'default-logo.png',
            'address'       => '184 Senpara Parbata, Mirpur 10, Dhaka 1216',
            'site_phone'         => '01700000000',
            'site_email'         => 'info@nebulait.com',
            'currency'      => '৳',
            'footer_text'   => '© 2025 Nebula IT. All rights reserved.',
        ]);
    }
}
