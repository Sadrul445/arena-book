<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\PricingPeriod;
use App\Models\PricingRule;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $pricing = [
            'football-unit-1' => [
                [
                    'name' => 'Off-Peak',
                    'start' => '00:00:00',
                    'end' => '18:00:00',
                    'priority' => 1,
                    'rules' => [
                        60 => 1000,
                        90 => 1500,
                        120 => 2000,
                    ],
                ],
                [
                    'name' => 'Peak',
                    'start' => '18:00:00',
                    'end' => '23:59:59',
                    'priority' => 2,
                    'rules' => [
                        60 => 1350,
                        90 => 1800,
                        120 => 2400,
                    ],
                ],
            ],

            'football-unit-2' => [
                [
                    'name' => 'Off-Peak',
                    'start' => '00:00:00',
                    'end' => '18:00:00',
                    'priority' => 1,
                    'rules' => [
                        60 => 2000,
                        90 => 2500,
                        120 => 3350,
                    ],
                ],
                [
                    'name' => 'Peak',
                    'start' => '18:00:00',
                    'end' => '23:59:59',
                    'priority' => 2,
                    'rules' => [
                        60 => 2500,
                        90 => 3000,
                        120 => 4000,
                    ],
                ],
            ],

            'cricket-unit-1' => [
                [
                    'name' => 'Standard',
                    'start' => '00:00:00',
                    'end' => '23:59:59',
                    'priority' => 1,
                    'rules' => [
                        60 => 1500,
                        90 => 2000,
                        120 => 2650,
                    ],
                ],
            ],

            'cricket-unit-2' => [
                [
                    'name' => 'Standard',
                    'start' => '00:00:00',
                    'end' => '23:59:59',
                    'priority' => 1,
                    'rules' => [
                        60 => 3000,
                        90 => 4000,
                        120 => 5350,
                    ],
                ],
            ],

            'swimming-pool' => [
                [
                    'name' => 'Standard',
                    'start' => '10:00:00',
                    'end' => '23:59:59',
                    'priority' => 1,
                    'rules' => [
                        60 => 250,
                    ],
                ],
            ],

            'paddle-boat' => [
                [
                    'name' => 'Standard',
                    'start' => '10:00:00',
                    'end' => '23:59:59',
                    'priority' => 1,
                    'rules' => [
                        15 => 150,
                    ],
                ],
            ],

            'kayaking' => [
                [
                    'name' => 'Standard',
                    'start' => '10:00:00',
                    'end' => '23:59:59',
                    'priority' => 1,
                    'rules' => [
                        15 => 150,
                    ],
                ],
            ],

            'kids-zone' => [
                [
                    'name' => 'Standard',
                    'start' => '11:00:00',
                    'end' => '23:00:00',
                    'priority' => 1,
                    'rules' => [
                        60 => 300,
                        120 => 500,
                    ],
                ],
            ],
        ];

        foreach ($pricing as $slug => $periods) {
            $facility = Facility::where('slug', $slug)->firstOrFail();

            foreach ($periods as $periodData) {
                $period = PricingPeriod::updateOrCreate(
                    [
                        'facility_id' => $facility->id,
                        'name' => $periodData['name'],
                    ],
                    [
                        'start_time' => $periodData['start'],
                        'end_time' => $periodData['end'],
                        'priority' => $periodData['priority'],
                        'status' => true,
                    ]
                );

                foreach ($periodData['rules'] as $duration => $price) {
                    PricingRule::updateOrCreate(
                        [
                            'pricing_period_id' => $period->id,
                            'duration_minutes' => $duration,
                        ],
                        [
                            'price' => $price,
                            'currency' => 'BDT',
                            'status' => true,
                        ]   
                    );
                }
            }
        }
    }
}
