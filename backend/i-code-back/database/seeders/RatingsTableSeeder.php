<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingRecords = [
            ['id'=> 1,'user_id' => 1, 'product_id' => 11,'review' => 'Its really good','rating' => 4,'status' => 1],
            ['id'=> 2,'user_id' => 1, 'product_id' => 12,'review' => 'Its really good','rating' => 4,'status' => 1],
        ];
        Rating::insert($ratingRecords);
    }
}
