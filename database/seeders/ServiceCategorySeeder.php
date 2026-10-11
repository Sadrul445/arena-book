<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Football',
                'slug' => 'football',
                'description' => 'Football booking facilities',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cricket',
                'slug' => 'cricket',
                'description' => 'Cricket booking facilities',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Swimming',
                'slug' => 'swimming',
                'description' => 'Swimming pool facilities',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Water Activities',
                'slug' => 'water-activities',
                'description' => 'Paddle boat and kayaking',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kids Zone',
                'slug' => 'kids-zone',
                'description' => 'Indoor kids play facilities',
                'status' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
