<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationCoordinatesSeeder extends Seeder
{
    /**
     * Run the database seeds to add coordinates to transportation routes.
     */
    public function run(): void
    {
        $transportationCoordinates = [
            'Blitar - Jakarta' => [
                [112.1640, -8.0980], // Stasiun Blitar
                [112.2640, -7.9980],
                [112.3640, -7.8980],
                [112.5640, -7.7980],
                [112.7640, -7.6980],
                [112.9640, -7.5980],
                [113.1640, -7.4980],
                [113.5640, -7.2980],
                [114.0640, -7.0980],
                [114.5640, -6.8980],
                [115.0640, -6.6980],
                [116.5640, -6.5980],
                [106.8456, -6.2088], // Stasiun Gambir Jakarta
            ],
            'Blitar - Surabaya' => [
                [112.1640, -8.0980], // Stasiun Blitar
                [112.2140, -8.0780],
                [112.2640, -8.0580],
                [112.3640, -8.0180],
                [112.4640, -7.9780],
                [112.5640, -7.9380],
                [112.6640, -7.8980],
                [112.7520, -7.7490], // Stasiun Surabaya
            ],
            'Blitar - Malang' => [
                [112.1680, -8.1020], // Terminal Blitar
                [112.1880, -8.0920],
                [112.2180, -8.0820],
                [112.2680, -8.0520],
                [112.3180, -8.0220],
                [112.4180, -8.0120],
                [112.5180, -8.0020],
                [112.6300, -7.9800], // Terminal Malang
            ],
            'Blitar - Kediri' => [
                [112.1680, -8.1020], // Terminal Blitar
                [112.1980, -8.0820],
                [112.2280, -8.0620],
                [112.2580, -8.0420],
                [112.1580, -8.0020],
                [112.0580, -7.9220],
                [112.0100, -7.8190], // Terminal Kediri
            ],
            'Blitar - Tulungagung' => [
                [112.1680, -8.1020], // Terminal Blitar
                [112.1580, -8.1220],
                [112.1480, -8.1320],
                [112.1180, -8.1520],
                [112.0880, -8.1720],
                [112.0580, -8.1920],
                [112.0080, -8.0910], // Terminal Tulungagung
            ]
        ];

        foreach ($transportationCoordinates as $routeName => $coordinates) {
            $transportation = Transportation::where('route_name', $routeName)->first();
            
            if ($transportation) {
                $transportation->update(['coordinates' => $coordinates]);
            }
        }
    }
} 