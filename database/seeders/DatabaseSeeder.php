<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Destination;
use App\Models\NotificationItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Kawan Jalan',
            'email' => 'admin@kawanjalan.com',
            'phone' => '0811111111',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => 'User Wisatawan',
            'email' => 'user@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'country' => 'Indonesia',
            'city' => 'Bogor',
            'address' => 'Jl. Kawan Jalan No. 6',
        ]);

        $cities = [
            ['Bogor', 'bogor', 'assets/kawan/cities/bogor.jpg'],
            ['Bandung', 'bandung', 'assets/kawan/cities/bandung.jpg'],
            ['Garut', 'garut', 'assets/kawan/cities/garut.jpg'],
            ['Sukabumi', 'sukabumi', 'assets/kawan/cities/sukabumi.webp'],
        ];

        foreach ($cities as [$name, $slug, $image]) {
            City::create(['name' => $name, 'slug' => $slug, 'image' => $image]);
        }

        $bogor = City::where('slug', 'bogor')->first();
        $bandung = City::where('slug', 'bandung')->first();
        $garut = City::where('slug', 'garut')->first();

        $destinations = [
            [$bogor, 'Curug Cikuluwung', 25000, 'Air terjun dengan tebing bebatuan dan suasana alam yang segar.', 'Cibitung Wetan, Pamijahan, Bogor', '08.00-16.00 WIB', true, 'assets/kawan/destinations/curug-cikuluwung.jpg'],
            [$bogor, 'Curug Ciberang', 40000, 'Wisata alam sungai yang cocok untuk petualangan dan aktivitas seru bersama rombongan.', 'Bogor', '07.00-18.00 WIB', true, 'assets/kawan/destinations/curug-ciberang.webp'],
            [$bogor, 'Museum Etnobotani', 15000, 'Museum edukasi dengan koleksi budaya dan tanaman Indonesia.', 'Bogor', '08.00-16.00 WIB', true, 'assets/kawan/destinations/museum-etnobotani.jpg'],
            [$bogor, 'Kebun Raya Bogor', 16000, 'Destinasi hijau ikonik di pusat kota Bogor.', 'Bogor', '08.00-16.00 WIB', true, 'assets/kawan/destinations/kebun-raya-bogor.jpg'],
            [$bogor, 'JungleLand Adventure', 155000, 'Tempat rekreasi keluarga dan wahana permainan.', 'Sentul, Bogor', '10.00-17.00 WIB', true, 'assets/kawan/destinations/jungleland-adventure.webp'],
            [$bogor, 'Taman Safari Bogor', 450000, 'Wisata satwa favorit untuk keluarga dan rombongan.', 'Cisarua, Bogor', '08.30-17.00 WIB', true, 'assets/kawan/destinations/taman-safari-bogor.webp'],
            [$bandung, 'Gedung Sate', 35000, 'Ikon Kota Bandung dan wisata sejarah arsitektur.', 'Bandung', '08.00-16.00 WIB', false, 'assets/kawan/destinations/gedung-sate.jpg'],
            [$bandung, 'The Great Asia Afrika', 50000, 'Taman miniatur budaya negara Asia Afrika dengan spot foto menarik.', 'Bandung', '09.00-18.00 WIB', false, 'assets/kawan/destinations/the-great-asia-afrika.webp'],
            [$garut, 'Situ Bagendit', 30000, 'Wisata danau populer di Garut untuk keluarga.', 'Garut', '08.00-17.00 WIB', false, 'assets/kawan/destinations/situ-bagendit.webp'],
        ];

        foreach ($destinations as $row) {
            Destination::create([
                'city_id' => $row[0]->id,
                'name' => $row[1],
                'slug' => Str::slug($row[1]),
                'image' => $row[7],
                'description' => $row[3],
                'ticket_price' => $row[2],
                'open_hour' => $row[5],
                'location' => $row[4],
                'is_popular' => $row[6],
                'is_recommended' => true,
                'activity_count' => 1,
            ]);
        }

        $curug = Destination::where('slug', 'curug-cikuluwung')->first();
        $jungleLand = Destination::where('slug', 'jungleland-adventure')->first();
        $user->favorites()->attach(array_filter([$curug?->id, $jungleLand?->id]));

        Order::create([
            'user_id' => $user->id,
            'destination_id' => $curug->id,
            'guide_name' => 'Pemandu Kawan Jalan',
            'guide_phone' => '0812-3456-7890',
            'ticket_price' => 25000,
            'guide_fee' => 250000,
            'admin_fee' => 10000,
            'ticket_quantity' => 1,
            'include_guide' => true,
            'total' => 285000,
            'status' => 'paid',
            'payment_method' => 'QRIS',
            'payment_deadline' => now()->addMinutes(15),
            'paid_at' => now(),
            'ticket_code' => 'TM3288422',
            'group_barcode' => 'GRP-TM3288422',
        ]);

        NotificationItem::create(['user_id' => $user->id, 'title' => 'Booking Berhasil!', 'message' => 'Booking Anda untuk Curug Cikuluwung telah dikonfirmasi. Guide akan menghubungi Anda segera.', 'type' => 'success']);
        NotificationItem::create(['user_id' => $user->id, 'title' => 'Promo Spesial', 'message' => 'Dapatkan diskon 20% untuk booking wisata minggu ini!', 'type' => 'info']);
        NotificationItem::create(['user_id' => $user->id, 'title' => 'Perubahan Jadwal', 'message' => 'Jadwal kunjungan Anda diundur 1 jam karena cuaca.', 'type' => 'warning']);
        NotificationItem::create(['user_id' => $user->id, 'title' => 'Review Wisata', 'message' => 'Bagaimana pengalaman Anda di Kebun Raya Bogor? Berikan rating!', 'type' => 'info']);
    }
}
