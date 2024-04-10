<?php

namespace Database\Seeders;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsletterSubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriberRecord = [
            [
                'id' => 1, 'email' => 'i@gmail.com', 'status' => 1
            ],
            [
                'id' => 2, 'email' => 'e@gmail.com', 'status' => 1
            ],
        ];

        NewsletterSubscriber::insert($subscriberRecord);
    }
}
