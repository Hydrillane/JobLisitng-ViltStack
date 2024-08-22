<?php

namespace Database\Seeders;

use App\Models\Listing;
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

    User::factory(10)->create();

        $userIds = User::pluck('id')->toArray();
 Listing::factory(100)->create(function () use ($userIds) {
        $salary_min = floor(rand(30000, 100000) / 10000) * 10000;
        $salary_max = floor(rand($salary_min, max($salary_min + 30000, 200000)) / 10000) * 10000;
            return [
                'by_user_id' => $userIds[array_rand($userIds)],
                'salary_min' => $salary_min,
                'salary_max' => $salary_max,            ];
        });

    }
}
