<?php

namespace Database\Seeders;

use App\Models\LocalRoute;
use Illuminate\Database\Seeder;

class LocalRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            [
                'name' => 'Angkot Trayek A (Terminal - Kota)',
                'type' => 'angkot',
                'price' => 5000,
                'frequency' => 'Setiap 15 menit',
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal
                    [112.1700, -8.0950],
                    [112.1720, -8.0900],
                    [112.1680, -8.0850], // Kota
                ]
            ],
            [
                'name' => 'Bus Blitar - Malang',
                'type' => 'bus',
                'price' => 35000,
                'frequency' => 'Setiap 30 menit',
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1880, -8.0920],
                    [112.2180, -8.0820],
                    [112.2680, -8.0520],
                    [112.3180, -8.0220],
                    [112.6300, -7.9800], // Terminal Malang
                ]
            ],
            [
                'name' => 'Kereta Api Blitar - Surabaya',
                'type' => 'kereta',
                'price' => 80000,
                'frequency' => 'Setiap 2 jam',
                'coordinates' => [
                    [112.1640, -8.0980], // Stasiun Blitar
                    [112.2140, -8.0780],
                    [112.2640, -8.0580],
                    [112.3140, -8.0380],
                    [112.3640, -8.0180],
                    [112.7520, -7.7490], // Stasiun Surabaya
                ]
            ],
            [
                'name' => 'Travel Blitar - Kediri',
                'type' => 'travel',
                'price' => 40000,
                'frequency' => 'Setiap 1 jam',
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1980, -8.0820],
                    [112.2280, -8.0620],
                    [112.2580, -8.0420],
                    [112.0100, -7.8190], // Terminal Kediri
                ]
            ],
            [
                'name' => 'Angkot Trayek B (Terminal - Makam Bung Karno)',
                'type' => 'angkot',
                'price' => 4000,
                'frequency' => 'Setiap 15 menit',
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal
                    [112.1700, -8.0950],
                    [112.1720, -8.0900],
                    [112.1740, -8.0800],
                    [112.1731, -8.0768], // Makam Bung Karno
                ]
            ],
        ];

        foreach ($routes as $route) {
            LocalRoute::updateOrCreate(
                ['name' => $route['name']],
                $route
            );
        }
    }
} 