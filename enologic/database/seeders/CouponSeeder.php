<?php

namespace Database\Seeders;

use  App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'name' => 'FIRSTORDER20',
            'uses' => 20,
            'percentage' => 20,
        ]);

        Coupon::create([
            'name' => 'WEEKENDSALE10',
            'uses' => 16,
            'percentage' => 10,
        ]);
    }
}
