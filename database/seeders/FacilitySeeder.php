<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [[
                'category' => 'football',
                'name' => 'Football Unit 1', 
                'slug' => 'football-unit-1', 
                'description' => '10-player football unit', 
                'capacity_type' => 'booking', 
                'capacity' => 1, 
                'pricing_type' => 'fixed', 
                'sort_order' => 1,
            ], 
            [
                'category' => 'football',
                'name' => 'Football Unit 2', 
                'slug' => 'football-unit-2', 
                'description' => '14-player football unit', 
                'capacity_type' => 'booking',
                'capacity' => 1, 
                'pricing_type' => 'fixed', 
                'sort_order' => 2,
            ], 
            [
                'category' => 'cricket', 
                'name' => 'Cricket Unit 1', 
                'slug' => 'cricket-unit-1', 
                'description' => '14-player cricket unit', 
                'capacity_type' => 'booking', 
                'capacity' => 1, 
                'pricing_type' => 'fixed', 
                'sort_order' => 3,
            ], 
            [
                'category' => 'cricket', 'name' => 'Cricket Unit 2', 'slug' => 'cricket-unit-2', 'description' => '16-player cricket unit', 'capacity_type' => 'booking', 'capacity' => 1, 'pricing_type' => 'fixed', 'sort_order' => 4,], ['category' => 'swimming', 'name' => 'Swimming Pool', 'slug' => 'swimming-pool', 'description' => 'Swimming pool entry', 'capacity_type' => 'person', 'capacity' => 50, 'pricing_type' => 'per_person', 'sort_order' => 5,], ['category' => 'water-activities', 'name' => 'Paddle Boat', 'slug' => 'paddle-boat', 'description' => 'Paddle boat activity', 'capacity_type' => 'person', 'capacity' => 1, 'pricing_type' => 'per_person', 'sort_order' => 6,], ['category' => 'water-activities', 'name' => 'Kayaking', 'slug' => 'kayaking', 'description' => 'Kayaking activity', 'capacity_type' => 'person', 'capacity' => 1, 'pricing_type' => 'per_person', 'sort_order' => 7,], ['category' => 'kids-zone', 'name' => 'Kids Zone', 'slug' => 'kids-zone', 'description' => 'Indoor play zone for children aged 1–3', 'capacity_type' => 'person', 'capacity' => 1, 'pricing_type' => 'per_person', 'sort_order' => 8,],];
        foreach ($facilities as $item) {
            $category = ServiceCategory::where(
                'slug', 
                $item['category'])
                ->firstOrFail();
                
            unset(
                $item['category']);

            Facility::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, [
                    'service_category_id' => $category->id,
                    'status' => true,
                    ]
                ));
        }
    }
}
