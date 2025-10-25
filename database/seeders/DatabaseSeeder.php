<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Book;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== Users (demo) =====
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            ['name' => 'User', 'password' => Hash::make('12345678'), 'role' => 'user']
        );

        // // ===== Teams (penanda React) =====
        // Team::query()->delete(); // supaya tidak dobel saat seeding ulang
        // Team::insert([
        //     ['name'=>'BuatkanBuku Team','member_name'=>'Rendy','role'=>'Front-end','created_at'=>now(),'updated_at'=>now()],
        //     ['name'=>'BuatkanBuku Team','member_name'=>'Diva','role'=>'Back-end','created_at'=>now(),'updated_at'=>now()],
        //     ['name'=>'BuatkanBuku Team','member_name'=>'Iqbal','role'=>'QA','created_at'=>now(),'updated_at'=>now()],
        // ]);

        // ===== 100 Buku (judul nyata) =====
        // NOTE: ISBN dibuat dummy unik. Cover memakai satu gambar default.
        $now = Carbon::now();
        $titles = [
    // 1–20
    ['Laskar Pelangi','Andrea Hirata',2005],
    ['Sang Pemimpi','Andrea Hirata',2006],
    ['Edensor','Andrea Hirata',2007],
    ['Maryamah Karpov','Andrea Hirata',2008],
    ['Negeri 5 Menara','Ahmad Fuadi',2009],
    ['Ranah 3 Warna','Ahmad Fuadi',2011],
    ['Rantau 1 Muara','Ahmad Fuadi',2013],
    ['Bumi Manusia','Pramoedya Ananta Toer',1980],
    ['Anak Semua Bangsa','Pramoedya Ananta Toer',1980],
    ['Jejak Langkah','Pramoedya Ananta Toer',1985],
    ['Rumah Kaca','Pramoedya Ananta Toer',1988],
    ['Ayat-Ayat Cinta','Habiburrahman El Shirazy',2004],
    ['Ketika Cinta Bertasbih','Habiburrahman El Shirazy',2007],
    ['Dalam Mihrab Cinta','Habiburrahman El Shirazy',2008],
    ['Perahu Kertas','Dewi Lestari',2009],
    ['Supernova: Ksatria, Putri, dan Bintang Jatuh','Dewi Lestari',2001],
    ['Supernova: Akar','Dewi Lestari',2002],
    ['Supernova: Petir','Dewi Lestari',2004],
    ['Supernova: Partikel','Dewi Lestari',2012],
    ['Supernova: Gelombang','Dewi Lestari',2014],

    // 21–40
    ['Supernova: Intelegensi Embun Pagi','Dewi Lestari',2016],
    ['Rectoverso','Dewi Lestari',2008],
    ['Sabtu Bersama Bapak','Adhitya Mulya',2014],
    ['Critical Eleven','Ika Natassa',2015],
    ['Antologi Rasa','Ika Natassa',2011],
    ['Divortiare','Ika Natassa',2008],
    ['Twivortiare','Ika Natassa',2012],
    ['Cinta Brontosaurus','Raditya Dika',2006],
    ['Koala Kumal','Raditya Dika',2015],
    ['Marmut Merah Jambu','Raditya Dika',2010],
    ['Kambing Jantan','Raditya Dika',2005],
    ['Manusia Setengah Salmon','Raditya Dika',2011],
    ['Catatan Juang','Fiersa Besari',2016],
    ['11:11','Fiersa Besari',2018],
    ['Arah Langkah','Fiersa Besari',2019],
    ['Garis Waktu','Fiersa Besari',2016],
    ['Rindu','Tere Liye',2014],
    ['Hujan','Tere Liye',2016],
    ['Pulang','Tere Liye',2015],
    ['Pergi','Tere Liye',2018],

    // 41–60
    ['Negeri Para Bedebah','Tere Liye',2012],
    ['Negeri di Ujung Tanduk','Tere Liye',2013],
    ['Bumi','Tere Liye',2014],
    ['Bulan','Tere Liye',2015],
    ['Matahari','Tere Liye',2016],
    ['Bintang','Tere Liye',2017],
    ['Ceros dan Batozar','Tere Liye',2018],
    ['Komet','Tere Liye',2018],
    ['Komet Minor','Tere Liye',2019],
    ['Selena','Tere Liye',2020],
    ['Nebula','Tere Liye',2020],
    ['Si Anak Spesial','Tere Liye',2018],
    ['Si Anak Badai','Tere Liye',2020],
    ['Si Anak Pelangi','Tere Liye',2021],
    ['Orang-Orang Biasa','Andrea Hirata',2019],
    ['Sepotong Senja untuk Pacarku','Seno Gumira Ajidarma',1991],
    ['Jazz, Parfum dan Insiden','Seno Gumira Ajidarma',1996],
    ['Biola Tak Berdawai','Seno Gumira Ajidarma',1998],
    ['Pulang','Leila S. Chudori',2012],
    ['Laut Bercerita','Leila S. Chudori',2017],

    // 61–80
    ['9 dari Nadira','Leila S. Chudori',2009],
    ['Para Priyayi','Umar Kayam',1992],
    ['Sri Sumarah','Umar Kayam',1975],
    ['Burung-Burung Manyar','Y.B. Mangunwijaya',1981],
    ['Cantik Itu Luka','Eka Kurniawan',2002],
    ['Lelaki Harimau','Eka Kurniawan',2004],
    ['Seperti Dendam, Rindu Harus Dibayar Tuntas','Eka Kurniawan',2014],
    ['Lelaki Tua dan Laut','Ida Bagus Oka',1990],
    ['Bukan Pasar Malam','Pramoedya Ananta Toer',1951],
    ['Larung','Ayu Utami',2001],
    ['Saman','Ayu Utami',1998],
    ['Amba','Laksmi Pamuntjak',2012],
    ['Aruna dan Lidahnya','Laksmi Pamuntjak',2014],
    ['Pulau Buru','Pramoedya Ananta Toer',1999],
    ['Di Tanah Lada','Ziggy Zezsyazeoviennazabrizkie',2015],
    ['Kita Pergi Hari Ini','Ziggy Zezsyazeoviennazabrizkie',2020],
    ['Pasung Jiwa','Okky Madasari',2013],
    ['Entrok','Okky Madasari',2010],
    ['Maryam','Okky Madasari',2012],
    ['Kerumunan Terakhir','Okky Madasari',2016],

    // 81–100
    ['Tarian Bumi','Oka Rusmini',2000],
    ['Kenanga','Oka Rusmini',2003],
    ['Tempurung','Oka Rusmini',2010],
    ['Cinta di dalam Gelas','Andrea Hirata',2010],
    ['Padang Bulan','Andrea Hirata',2010],
    ['Sirkus Pohon','Andrea Hirata',2017],
    ['Dwilogi Padang Bulan','Andrea Hirata',2011],
    ['Lelaki yang Tak Pernah Pergi','Mochamad Sobary',2018],
    ['Filosofi Kopi','Dewi Lestari',2006],
    ['Tujuh Kelana','Tere Liye',2022],
    ['Si Anak Spesial 2','Tere Liye',2023],
    ['Mata dan Manusia Laut','Okky Madasari',2017],
    ['Mata dan Rahasia Pulau Gapi','Okky Madasari',2018],
    ['Mata dan Nyala Api Purba','Okky Madasari',2019],
    ['Buku Besar Peminum Kopi','Seno Gumira Ajidarma',2015],
    ['Rahasia Meede','E.S. Ito',2007],
    ['Negeri Senja','Seno Gumira Ajidarma',1999],
    ['Jalan Tak Ada Ujung','Mochtar Lubis',1952],
    ['Awan dan Angin','Sapardi Djoko Damono',1999],
    ['Hujan Bulan Juni','Sapardi Djoko Damono',1994],
];

        // bersihkan dulu supaya tidak duplicate saat seeding berulang
        Book::query()->delete();

        $books = [];
        foreach ($titles as $i => [$title,$author,$year]) {
            $idx = $i + 1;
            $books[] = [
                'title'       => $title,
                'author'      => $author,
                // ISBN dummy unik 13 digit
                'isbn'        => '9789'.str_pad((string)$idx, 11, '0', STR_PAD_LEFT),
                'year'        => $year,
                'stock'       => random_int(1, 20),
                'cover_path'  => 'covers/default.jpg', // 1 gambar dipakai semua
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }

        Book::insert($books);
    }
}
