<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            File::create([
                'document_code' => 'DOC-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'subject' => $faker->sentence(3),
                'originating_office' => $faker->company,
                'remarks' => $faker->sentence(6),
                'file' => $faker->randomElement([
                    'report.pdf',
                    'contract.docx',
                    'scan.jpg',
                    'blueprint.png',
                    'memo.doc'
                ]),
                'date' => $faker->date(),
                'folder_id' => $faker->numberBetween(1, 10),
                'user_id' => 1,
            ]);
        }
    }
}
