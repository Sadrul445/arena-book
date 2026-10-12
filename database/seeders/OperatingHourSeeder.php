<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\OperatingHour;

class OperatingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = Facility::all();

        foreach ($facilities as $facility) {
            for ($day = 0; $day <= 6; $day++) {
                $start = '10:00:00';
                $end = '23:59:00';

                // Cricket facilities: 24 hours
                if ($facility->category->slug === 'cricket') {
                    $start = '00:00:00';
                    $end = '23:59:00';
                }

                // Kids Zone: 11 AM - 11 PM
                if ($facility->slug === 'kids-zone') {
                    $start = '11:00:00';
                    $end = '23:00:00';
                }

                OperatingHour::updateOrCreate(
                    [
                        'facility_id' => $facility->id,
                        'day_of_week' => $day,
                    ],
                    [
                        'start_time' => $start,
                        'end_time' => $end,
                        'is_closed' => false,
                    ]
                );
            }
        }
    }
}
