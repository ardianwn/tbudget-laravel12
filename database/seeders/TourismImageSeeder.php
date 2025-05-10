<?php

namespace Database\Seeders;

use App\Models\Tourism;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourismImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagesByType = [
            'tourism' => [
                'https://imgcy.trivago.com/c_limit,d_dummy.jpeg,f_auto,h_600,q_auto,w_600/itemimages/62/04/6204746.jpeg',
                'https://www.indonesia.travel/content/dam/indtravelrevamp/en/destinations/indonesia-travel-icon.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/c5/00/95/blitar.jpg?w=1200&h=-1&s=1',
                'https://indonesiakaya.com/wp-content/uploads/2020/10/6__Istana_Gebang.jpg',
                'https://upload.wikimedia.org/wikipedia/commons/3/36/Istana_Gebang.jpg',
            ],
            'park' => [
                'https://asset.kompas.com/crops/FSCiKaGId7Z8XPVl0ySBJP1KzkA=/0x0:0x0/750x500/data/photo/2020/06/28/5ef80447bf7c0.jpeg',
                'https://lh3.googleusercontent.com/p/AF1QipOLAlYGIo-EB_QeADQqDI38fzpKDlOvfxfL2Bux=s1360-w1360-h1020',
                'https://www.travelspromo.com/wp-content/uploads/2021/11/Taman-Kota-Blitar.jpg',
                'https://salsawisata.com/wp-content/uploads/2022/01/Taman-Kebon-Rojo-Blitar.jpg',
            ],
            'beach' => [
                'https://www.nativeindonesia.com/foto/2017/09/Keindahan-Pantai-Tambak-1.jpg',
                'https://travelspromo.com/wp-content/uploads/2020/03/Tebing-tinggi-di-Pantai-Jolosutro-Adib-Wahyu-Fatoni-2048x1151.jpg',
                'https://asset.kompas.com/crops/1zH1mYmyEd_EUeAWn1hm2Xqg4Ew=/0x0:739x493/750x500/data/photo/2021/12/22/61c2b9686bbc2.jpg',
                'https://indonesiakaya.com/wp-content/uploads/2020/10/1_pantai_tambakrejo_5.jpg',
            ],
            'temple' => [
                'https://upload.wikimedia.org/wikipedia/commons/0/0e/Candi_Penataran_1.jpg',
                'https://upload.wikimedia.org/wikipedia/commons/d/d6/Candi_Sawentar.jpg',
                'https://asset.kompas.com/crops/G1xhfIJ4UqRwRkpSXGXDXNqJdLQ=/0x154:1080x874/750x500/data/photo/2022/09/11/631da4dd825cf.jpg',
                'https://www.indonesia.travel/content/dam/indtravelrevamp/id-id/ide-liburan/5-objek-wisata-candi-di-blitar-yang-meninggalkan-sejarah-panjang/image7a.jpg',
            ],
            'mountain' => [
                'https://awsimages.detik.net.id/community/media/visual/2019/01/22/82cda6a8-7dd5-4c9e-9be7-0fbaa188e354_169.jpeg?w=600&q=90',
                'https://asset.kompas.com/crops/4eIaCVvHBjAFE3I-V5btKmPKm_M=/47x0:732x457/750x500/data/photo/2020/01/01/5e0c1d61c39c9.jpg',
                'https://asset.kompas.com/crops/wztGMQb6OeC0TGYLMIYxEhbgOcI=/0x0:1800x1200/750x500/data/photo/2022/01/15/61e2953a97f3e.jpg',
                'https://disk.mediaindonesia.com/thumbs/1800x1200/news/2021/03/8ca0bd19f2e2fe86bf3b2ec14c61dcd2.jpg',
            ],
            'monument' => [
                'https://upload.wikimedia.org/wikipedia/id/4/44/Monumen_PETA.jpg',
                'https://assets.ayobandung.com/crop/0x0:0x0/750x500/webp/photo/2022/06/21/3108765954.jpg',
                'https://kelurahan-kepanjenkidul.blitarkota.go.id/wp-content/uploads/2021/05/PETA-KEPANJEN-KIDUL-765x490.jpg',
            ],
            'historical' => [
                'https://img.inews.co.id/media/822/files/inews_new/2021/11/15/makam_bung_karno.jpg',
                'https://assets.promediateknologi.com/crop/0x0:0x0/750x500/photo/jawapos/2020/12/31/IMG-20201231-WA0010.jpg',
                'https://lh3.googleusercontent.com/p/AF1QipONDBjZFxEpHAqf29KJL3GIeUNhVEF1JTXmPkct=s1360-w1360-h1020',
            ],
            'camping' => [
                'https://sgp1.digitaloceanspaces.com/kbadm/uploads/posts/2023/10/kblog-2023-10-21-camping-grounds-in-bali-the-6-best-spots-to-camp-in-bali-c1-kabbala-beach-campground-5d3f62.jpeg',
                'https://blog.traveloka.com/source/upload/2019/11/Camping-di-Malang-Sumber-Instagram-@jamburono_camground.jpeg',
                'https://images.genpi.co/uploads/data/images/2020/Juli/IMG-20200724-WA0026.jpg',
            ],
            'religious' => [
                'https://sikapiuangmu.ojk.go.id/FrontEnd/CMS/Image/20200224111204.jpg',
                'https://upload.wikimedia.org/wikipedia/commons/9/9d/Masjid_Agung_Kota_Blitar_4.jpg',
                'https://lh3.googleusercontent.com/p/AF1QipM4lxpxG_qgTqDpM2lq1qYl1vC1iTlcQ8rz0s8-=s1360-w1360-h1020',
            ],
            'accommodation' => [
                'https://pix8.agoda.net/hotelImages/23871211/-1/5e2cf10a8717c3b958b90ea0bf2dfd1c.jpg?ce=0&s=1024x768',
                'https://pix8.agoda.net/hotelImages/23871211/-1/e7a0e8efd3f0c2e7e80e0d565c9ea355.jpg?ca=14&ce=1&s=1024x768',
                'https://q-xx.bstatic.com/xdata/images/hotel/840x460/217400672.jpg?k=cf55034c13da7df5ee5c9de3788723b5a0eeed44fc7d858a18ad1a5423074f45&o=',
            ],
            'culinary' => [
                'https://lh3.googleusercontent.com/p/AF1QipM_EFH5Z5Ax3gE4WLCNR1A3XWLAL3dNPnvbz1hE=s1360-w1360-h1020',
                'https://lh3.googleusercontent.com/p/AF1QipObN_SIZWOxWyE6P2tS3IZrCG_I71hbzBnZoxC5=s1360-w1360-h1020',
                'https://lh3.googleusercontent.com/p/AF1QipP6D-ygTLXy9_TQUQaYfAQtWtQRTk-6k1T0qmxX=s1360-w1360-h1020',
            ],
            'rest_area' => [
                'https://lh3.googleusercontent.com/p/AF1QipNZJzMD9FD87LGsWK3SJlPR2R-vOTWBHWIeU8De=s1360-w1360-h1020',
                'https://lh3.googleusercontent.com/p/AF1QipMNe7bnhLCTEQcNcuOI_0XA2vAQEgC8nwjrQgiy=s1360-w1360-h1020',
                'https://travel.balirestaurantsguide.com/wp-content/uploads/2023/01/rest-area-nangka-1000x630.jpg',
            ],
            'agrotourism' => [
                'https://piknikwisata.com/wp-content/uploads/2019/12/agrowisata-belimbing-karangsari.jpg',
                'https://lh3.googleusercontent.com/p/AF1QipOs1JGy4rSm_GsVXhgFzqmBs9OfY6sPBYjwOlw=s1360-w1360-h1020',
                'https://lh3.googleusercontent.com/p/AF1QipNKoV1wEKCHZuXE8mqcXH2n_d9RA8gUh2SYa9oN=s1360-w1360-h1020',
            ],
        ];

        // Default image jika tipe tidak ditemukan
        $defaultImages = [
            'https://salsawisata.com/wp-content/uploads/2022/01/Wisata-Blitar.jpg',
            'https://assets.promediateknologi.com/crop/0x0:0x0/750x500/photo/radarsurabaya/2023/03/3.jpg',
            'https://disparbudpor.blitarkab.go.id/assets/images/fc0e7cdfc9a90a6d992c9c94e8d35d1e.jpg',
        ];

        // Mendapatkan semua data tourism
        $tourisms = Tourism::all();

        // Mengupdate kolom image untuk setiap tourism
        foreach ($tourisms as $tourism) {
            $type = $tourism->type;
            
            // Jika tipe ada di daftar, ambil gambar secara acak dari array tipe tersebut
            if (isset($imagesByType[$type])) {
                $images = $imagesByType[$type];
                $randomImage = $images[array_rand($images)];
            } else {
                // Jika tipe tidak ada, gunakan gambar default
                $randomImage = $defaultImages[array_rand($defaultImages)];
            }
            
            // Update kolom image
            DB::table('tourisms')
                ->where('id', $tourism->id)
                ->update(['image' => $randomImage]);
        }
    }
} 