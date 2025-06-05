<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Folder::create([
                'name' => $faker->words(2, true), // e.g., "Finance Reports"
                'description' => $faker->sentence(),
                'user_id' => 1,
            ]);
        }
    }
}
