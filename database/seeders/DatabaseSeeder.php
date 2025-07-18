<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'keochamraeun54@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'khraeun@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        Customer::create([
            'name' => 'Walk in Customer',
            'email' => 'walkin@gmail.com',
            'status' => 'active',
            'user_id' => 1,
        ]);
        Customer::create([
            'name' => 'Walk in Customer',
            'email' => 'walkin2@gmail.com',
            'status' => 'active',
            'user_id' => 2,
        ]);

        $this->call([
            SiteSettingSeeder::class,
            CategorySeeder::class
        ]);
    }
}
