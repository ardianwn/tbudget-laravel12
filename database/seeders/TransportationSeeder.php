<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportation::truncate();
        
        $transportations = [
            // 1. Kereta Api Blitar - Jakarta (via Surabaya & Semarang)
            [
                'route_name' => 'Blitar - Jakarta (Kereta Api)',
                'type' => 'Kereta Api',
                'price' => 350000,
                'duration_minutes' => 720,
                'departure_times' => ['06:00', '19:00'],
                'coordinates' => [
                    [112.1675, -8.0950], // Stasiun Blitar
                    [112.2010, -8.0620], // Stasiun Wlingi
                    [112.4430, -7.8660], // Stasiun Kepanjen
                    [112.6300, -7.9800], // Stasiun Malang
                    [112.7520, -7.7490], // Stasiun Surabaya Gubeng
                    [112.9830, -7.2580], // Stasiun Lamongan
                    [111.5137, -7.6127], // Stasiun Madiun (jika via selatan)
                    [110.4217, -6.9822], // Stasiun Semarang Tawang
                    [106.8456, -6.2088], // Stasiun Gambir Jakarta
                ]
            ],

            // 2. Kereta Api Blitar - Surabaya
            [
                'route_name' => 'Blitar - Surabaya (Kereta Api)',
                'type' => 'Kereta Api',
                'price' => 80000,
                'duration_minutes' => 240,
                'departure_times' => ['05:30', '09:45', '14:20', '18:30'],
                'coordinates' => [
                    [112.1675, -8.0950], // Stasiun Blitar
                    [112.2010, -8.0620], // Stasiun Wlingi
                    [112.4430, -7.8660], // Stasiun Kepanjen
                    [112.6300, -7.9800], // Stasiun Malang
                    [112.7520, -7.7490], // Stasiun Surabaya Gubeng
                ]
            ],

            // 3. Bus Blitar - Malang
            [
                'route_name' => 'Blitar - Malang (Bus)',
                'type' => 'Bus',
                'price' => 35000,
                'duration_minutes' => 120,
                'departure_times' => ['05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.2180, -8.0820], // Jalan Raya Wlingi
                    [112.3180, -8.0220], // Jalan Raya Garum
                    [112.4180, -8.0120], // Jalan Raya Talun
                    [112.5180, -8.0020], // Jalan Raya Kesamben
                    [112.6300, -7.9800], // Terminal Arjosari Malang
                ]
            ],

            // 4. Bus Blitar - Kediri
            [
                'route_name' => 'Blitar - Kediri (Bus)',
                'type' => 'Bus',
                'price' => 25000,
                'duration_minutes' => 90,
                'departure_times' => ['05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1480, -8.0820], // Jalan Raya Srengat
                    [112.1280, -8.0620], // Jalan Raya Kademangan
                    [112.1080, -8.0420], // Jalan Raya Kanigoro
                    [112.0580, -7.9220], // Jalan Raya Pagu
                    [112.0100, -7.8190], // Terminal Kediri
                ]
            ],

            // 5. Travel Blitar - Tulungagung
            [
                'route_name' => 'Blitar - Tulungagung (Travel)',
                'type' => 'Travel',
                'price' => 20000,
                'duration_minutes' => 60,
                'departure_times' => ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1580, -8.1220], // Jalan Raya Srengat
                    [112.1480, -8.1320], // Jalan Raya Wonodadi
                    [112.1180, -8.1520], // Jalan Raya Gondang
                    [112.0880, -8.1720], // Jalan Raya Ngunut
                    [112.0080, -8.0910], // Terminal Tulungagung
                ]
            ],

            // 6. Bus Blitar - Jombang
            [
                'route_name' => 'Blitar - Jombang (Bus)',
                'type' => 'Bus',
                'price' => 30000,
                'duration_minutes' => 150,
                'departure_times' => ['06:30', '08:30', '10:30', '13:30', '15:30'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1280, -8.0220], // Jalan Raya Wlingi
                    [112.0880, -7.9420], // Jalan Raya Garum
                    [112.0480, -7.8620], // Jalan Raya Talun
                    [112.0280, -7.7820], // Jalan Raya Kesamben
                    [112.2266, -7.5461], // Terminal Jombang
                ]
            ],

            // 7. Bus Blitar - Trenggalek
            [
                'route_name' => 'Blitar - Trenggalek (Bus)',
                'type' => 'Bus',
                'price' => 28000,
                'duration_minutes' => 120,
                'departure_times' => ['07:00', '09:00', '11:00', '13:00', '15:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1180, -8.1220], // Jalan Raya Srengat
                    [112.0680, -8.1420], // Jalan Raya Wonodadi
                    [112.0180, -8.1620], // Jalan Raya Gandusari
                    [111.9680, -8.1820], // Jalan Raya Panggul
                    [111.7080, -8.0504], // Terminal Trenggalek
                ]
            ],

            // 8. Travel Blitar - Nganjuk
            [
                'route_name' => 'Blitar - Nganjuk (Travel)',
                'type' => 'Travel',
                'price' => 35000,
                'duration_minutes' => 180,
                'departure_times' => ['06:00', '09:00', '12:00', '15:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.1180, -8.0220], // Jalan Raya Wlingi
                    [112.0680, -7.9420], // Jalan Raya Garum
                    [112.0180, -7.8620], // Jalan Raya Talun
                    [111.9780, -7.8120], // Jalan Raya Kertosono
                    [111.9070, -7.6050], // Terminal Nganjuk
                ]
            ],

            // 9. Kereta Api Blitar - Madiun
            [
                'route_name' => 'Blitar - Madiun (Kereta Api)',
                'type' => 'Kereta Api',
                'price' => 60000,
                'duration_minutes' => 240,
                'departure_times' => ['07:15', '12:30', '17:45'],
                'coordinates' => [
                    [112.1675, -8.0950], // Stasiun Blitar
                    [112.2010, -8.0620], // Stasiun Wlingi
                    [111.9640, -7.9980], // Stasiun Kertosono
                    [111.5137, -7.6127], // Stasiun Madiun
                ]
            ],

            // 10. Kereta Api Blitar - Semarang
            [
                'route_name' => 'Blitar - Semarang (Kereta Api)',
                'type' => 'Kereta Api',
                'price' => 120000,
                'duration_minutes' => 360,
                'departure_times' => ['08:00', '20:00'],
                'coordinates' => [
                    [112.1675, -8.0950], // Stasiun Blitar
                    [112.2010, -8.0620], // Stasiun Wlingi
                    [111.5137, -7.6127], // Stasiun Madiun
                    [110.4217, -6.9822], // Stasiun Semarang Tawang
                ]
            ],

            // 11. Travel Blitar - Probolinggo
            [
                'route_name' => 'Blitar - Probolinggo (Travel)',
                'type' => 'Travel',
                'price' => 75000,
                'duration_minutes' => 270,
                'departure_times' => ['05:00', '13:00'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.2680, -8.0520], // Jalan Raya Wlingi
                    [112.4680, -7.9520], // Jalan Raya Kepanjen
                    [112.7680, -7.8520], // Jalan Raya Malang
                    [113.2152, -7.7520], // Terminal Probolinggo
                ]
            ],

            // 12. Bus Blitar - Lumajang
            [
                'route_name' => 'Blitar - Lumajang (Bus)',
                'type' => 'Bus',
                'price' => 50000,
                'duration_minutes' => 210,
                'departure_times' => ['06:30', '14:30'],
                'coordinates' => [
                    [112.1680, -8.1020], // Terminal Blitar
                    [112.2680, -8.1220], // Jalan Raya Wlingi
                    [112.4680, -8.1620], // Jalan Raya Doko
                    [112.6680, -8.2020], // Jalan Raya Lumajang
                    [113.2234, -8.1337], // Terminal Lumajang
                ]
            ],
        ];

        foreach ($transportations as $transportation) {
            Transportation::create($transportation);
        }
    }
}