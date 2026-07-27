<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MuseumSeeder extends Seeder
{
    /**
     * Seed data komplit dari 3 PDF Asli Museum Talaga Manggung:
     * 1. KATALOG MTM PDF (Semua 17 Artefak Pusaka & Foto Asli PDF)
     * 2. PROFIL YAYASAN Talaga manggung sk PDF
     * 3. Portofolio Talaga Manggung (Final) PDF
     */
    public function run(): void
    {
        // 1. SEED USER ADMINISTRATOR
        User::updateOrCreate(
            ['email' => 'admin@museum.com'],
            [
                'name' => 'Administrator Museum',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. SEED ARTIKEL BERITA & SEJARAH (Tabel: berita)
        DB::table('berita')->truncate();
        DB::table('berita')->insert([
            [
                'kategori' => 'SEJARAH',
                'judul' => 'Asal Usul Bhumi Ageung & Bhumi Alit Kerajaan Talaga Manggung',
                'ringkasan' => 'Terletak di Desa Talagawetan Majalengka, Museum Talaga Manggung menyimpan benda peninggalan kejayaan Kerajaan Talaga yang dirintis sejak era Raja ke-VIII Rd. Apun Surawidjaja.',
                'konten_lengkap' => 'Pada era Raja ke-VIII Kerajaan Talaga, Raja Talaga Manggung yang kala itu bernama Rd. Apun Surawidjaja mendirikan pusat tata kelola pemerintahan yang disebut Bhumi Ageung. Tepat di seberangnya, Beliau mendirikan bangunan kecil bernama Bhumi Alit yang berfungsi sebagai gudang penyimpanan senjata dan barang penting kerajaan. Pasca masa peralihan, Bhumi Alit diubah fungsinya oleh para sesepuh keturunan raja menjadi Museum Talaga Manggung hingga hari ini.',
                'foto' => 'images/artefak/bhumi_ageung.jpg',
                'tanggal_publikasi' => '2026-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'TRADISI',
                'judul' => 'Pelaksanaan Tradisi Tahunan Nyiramkeun Pusaka Talaga Manggung',
                'ringkasan' => 'Upacara ritual pembersihan benda pusaka peninggalan leluhur Kerajaan Talaga yang diselenggarakan secara turun-temurun pada bulan Syafar.',
                'konten_lengkap' => 'Kegiatan Nyiramkeun Pusaka Talaga Manggung dilakukan secara rutin pada bulan Syafar hari Senin minggu ketiga dalam hitungan tanggal belasan dan ganjil. Kegiatan ini merupakan salah satu bentuk penghormatan dan pelestarian nilai-nilai sejarah budaya luhur masyarakat Talaga terhadap benda warisan nenek moyangnya yang tersimpan di Museum.',
                'foto' => 'images/artefak/ruang_pamer.jpg',
                'tanggal_publikasi' => '2026-06-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'PROFIL',
                'judul' => 'Resmi Berbadan Hukum: Profil Yayasan Talaga Manggung Simbar Kantjana',
                'ringkasan' => 'Yayasan Talaga Manggung Simbar Kantjana berizin resmi SK Kemenkumham RI No. AHU-0008860.AH.01.04.TAHUN 2018 untuk melestarikan aset budaya Majalengka.',
                'konten_lengkap' => 'Berdasarkan Akta Notaris Lala Sunara, ST, SH, MKn No. 04 tertanggal 10 Juli 2018 dan SK Menkumham RI, Yayasan Talaga Manggung Simbar Kantjana (TMSK) berdiri sebagai lembaga resmi yang berlokasi di Jl. Talaga - Majalengka No 09, Blok Babakan, Desa Talaga Kulon. Yayasan mengusung semboyan adat "Jaga Makeyana Patikrama Paninggalna Sya Seda" untuk mengoptimalkan potensi wawasan kebudayaan dan konservasi cagar budaya.',
                'foto' => 'images/artefak/batu_palungguhan.jpg',
                'tanggal_publikasi' => '2026-07-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'SEJARAH',
                'judul' => 'Rekam Jejak 9 Sesepuh Pengurus Pusaka Karuhun Talaga',
                'ringkasan' => 'Sejak tahun 1820 pasca penggabungan Kabupatian Talaga dan Sindangkasih, kepengurusan benda pusaka diamanahkan secara turun temurun kepada para sesepuh Talaga.',
                'konten_lengkap' => 'Musyawarah para sesepuh menentukan bahwa benda pusaka karuhun dikelola oleh keturunan langsung dari Pangeran Sacanata II (Bupati Panungtung Talaga). Silsilah pengurus dimulai dari Pangeran Sumanagara (1820-1840), Nyi Raden Anggrek (1840-1865), Raden Natakusumah (1865-1895), Raden Natadiputra (1895-1925), Nyi Raden Masri’ah (1925-1948), Raden Acap Kartadilaga (1948-1970), Nyi Raden Madinah (1970-1993), Nyi Raden Padnalarang (1993-2014), dan Raden Apun Tjahya Hendraningrat (2014-sekarang).',
                'foto' => 'images/artefak/arca_panglurah.jpg',
                'tanggal_publikasi' => '2026-07-10',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 3. SEED KOLEKSI ARTEFAK GALERI (Tabel: galeris - Total 17 Artefak Lengkap)
        DB::table('galeris')->truncate();
        DB::table('galeris')->insert([
            [
                'judul' => 'Arca Raden Panglurah',
                'deskripsi' => 'Arca perunggu berlapis (croom) emas peninggalan abad ke-13 era Kerajaan Talaga Manggung (Tinggi 19 Cm). Patung perunggu berbentuk Buddha duduk melipat kaki dengan sikap Bhumisparsa Mudra ini dipercaya sebagai gambaran sketsa wujud Raden Panglurah.',
                'kategori' => 'Arca Perunggu',
                'foto' => 'images/artefak/arca_panglurah.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Arca Simbar Kancana',
                'deskripsi' => 'Arca perunggu berlapis (croom) emas abad ke-13 (Tinggi 36,8 Cm). Arca berbentuk Buddha berdiri tegak dengan sikap Abhaya Mudra (telapak tangan kanan lurus ke depan), dipercaya merupakan gambaran wujud Nyi Ratu Dewi Simbarkancana, Ratu Kerajaan Talaga Manggung.',
                'kategori' => 'Arca Perunggu',
                'foto' => 'images/artefak/arca_simbar_kancana.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Keris Pusaka Karuhun Talaga',
                'deskripsi' => 'Senjata pusaka berbilah keris warisan para Raja dan Sesepuh Kerajaan Talaga Manggung yang disucikan dan dibersihkan setiap upacara adat Nyiramkeun.',
                'kategori' => 'Senjata Pusaka',
                'foto' => 'images/artefak/keris_pusaka.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kujang Pusaka Sunda Kuno',
                'deskripsi' => 'Senjata pusaka tradisional khas Pasundan peninggalan Kerajaan Talaga Manggung bermaterialkan logam perunggu dan besi pilihan.',
                'kategori' => 'Senjata Pusaka',
                'foto' => 'images/artefak/kujang_pusaka.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tombak Pusaka Kerajaan',
                'deskripsi' => 'Senjata tombak kuno peninggalan para pengawal dan kesatria Kerajaan Talaga Manggung.',
                'kategori' => 'Senjata Pusaka',
                'foto' => 'images/artefak/tombak_pusaka.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Baju Kere (Zirah Baja Kuno)',
                'deskripsi' => 'Rompi zirah perang yang terbuat dari baja kuno peninggalan prajurit Kerajaan Talaga Manggung.',
                'kategori' => 'Senjata & Zirah',
                'foto' => 'images/artefak/baju_zirah.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Golok Pusaka Kerajaan',
                'deskripsi' => 'Senjata landepan golok kuno koleksi Museum Talaga Manggung peninggalan masa pertahanan Kerajaan.',
                'kategori' => 'Senjata Pusaka',
                'foto' => 'images/artefak/golok_pusaka.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Cawan Zodiak Talaga (Prasen)',
                'deskripsi' => 'Cawan wadah air suci perunggu abad ke-13 M (Tinggi 111 mm, Diameter atas 144 mm) pelengkap ritual keagamaan era Batara Gunung Bitung hingga Nyi Ratu Simbarkancana. Bertatahkan relief 12 Rasi Bintang astronomi Sunda Kuno (Misa, M’risa, M’ri Kogo, Calicata, Singha, Canya, Tula, Priyata, Wanu, Macara, Cuba, Mena).',
                'kategori' => 'Wadah Ritual',
                'foto' => 'images/artefak/cawan_zodiak.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Genta Teratai Buddha',
                'deskripsi' => 'Lonceng/Genta perunggu abad kuno bermotif artistik bergaya Tibet (Tinggi 152 mm & Diameter 90 mm). Merupakan cendramata dari Biksu/Tamu Negara Tibet (Tiongkok) yang berkunjung ke Negeri Talaga untuk mempelajari ajaran "Dang Upaka Sarwatiwada" yang disebarkan Batara Gunung Bitung.',
                'kategori' => 'Lonceng Ritual',
                'foto' => 'images/artefak/genta_teratai.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Genta Singha Talaga',
                'deskripsi' => 'Genta perunggu bermotif Singha bergaya Tibet (Tinggi 277 mm & Diameter 125 mm) pelengkap ritual keagamaan era Batara Gunung Bitung. Fotonya pernah dipotret oleh Isidore Van Kinsbergen tahun 1856 dan tersimpan di Tropenmuseum Belanda.',
                'kategori' => 'Lonceng Ritual',
                'foto' => 'images/artefak/genta_singha.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Koleksi Terracotta & Keramik Kuno',
                'deskripsi' => 'Ornamen terakota dan pecahan keramik antik peninggalan eksterior bangunan serta perkakas rumah tangga Kerajaan Talaga Manggung.',
                'kategori' => 'Benda Bersejarah',
                'foto' => 'images/artefak/terracotta.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mata Uang Gobog Kuno',
                'deskripsi' => 'Koleksi uang logam kuno (Mata Uang Gobog) yang dipergunakan sebagai alat transaksi perdagangan era Kerajaan Talaga.',
                'kategori' => 'Uang Kuno & Komoditas',
                'foto' => 'images/artefak/uang_gobog.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perangkat Goong Renteng & Kenong',
                'deskripsi' => 'Perangkat gamelan perunggu kuno khas Sunda peninggalan seni budaya istana Kerajaan Talaga Manggung.',
                'kategori' => 'Karya Seni Budaya',
                'foto' => 'images/artefak/goong_renteng.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Meriam Cetbang & Rantaka',
                'deskripsi' => 'Senjata meriam api tradisional Nusantara peninggalan pertahanan maritim dan darat Kerajaan Talaga.',
                'kategori' => 'Senjata Berpeledak',
                'foto' => 'images/artefak/meriam_cetbang.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Senapan Sulut Arquebush (Bedil Dorlok)',
                'deskripsi' => 'Koleksi 14 unit senapan api sulut kuno milik Kerajaan Talaga Manggung yang tersimpan rapi di Museum.',
                'kategori' => 'Senjata Berpeledak',
                'foto' => 'images/artefak/senapan_sulut.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Batu Lingga Yoni',
                'deskripsi' => 'Situs batu Lingga Yoni peninggalan peradaban masa Hindu-Buddha yang terletak di halaman depan Museum Talaga Manggung.',
                'kategori' => 'Prasasti & Batu Site',
                'foto' => 'images/artefak/batu_lingga.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Batu Palungguhan / Batu Pentasbih',
                'deskripsi' => 'Batu situs tempat penobatan Raja dan Putra Mahkota Kerajaan Talaga Manggung yang terletak di pelataran halaman Museum Talaga Manggung.',
                'kategori' => 'Prasasti & Batu Site',
                'foto' => 'images/artefak/batu_palungguhan.jpg',
                'link_3d' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 4. SEED DOKUMENTER WALANG SUJI (Tabel: walang_suji_videos)
        DB::table('walang_suji_videos')->truncate();
        DB::table('walang_suji_videos')->insert([
            [
                'title' => 'Prosesi Adat Ritual Nyiramkeun Pusaka Talaga Manggung',
                'duration' => '12:45',
                'sort_order' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description' => 'Dokumentasi lengkap ritual pembersihan air suci benda-benda pusaka leluhur Kerajaan Talaga Manggung yang dilaksanakan setiap bulan Syafar di Bhumi Alit.',
                'guide_pdf_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rekonstruksi Sejarah Tata Pemerintahan Bhumi Ageung',
                'duration' => '08:30',
                'sort_order' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description' => 'Narasinya mengulas kembali sejarah pendirian tempat tatanan pemerintahan oleh Raja Rd. Apun Surawidjaja pada abad ke-16.',
                'guide_pdf_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bedah Filosofi 12 Rasi Bintang Cawan Zodiak Talaga',
                'duration' => '15:10',
                'sort_order' => 3,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'description' => 'Penjelasan mendalam mengenai temuan cawan wadah air suci perunggu abad 13 bertatahkan rasi astronomi Sunda Kuno yang pernah dicatat oleh T.S. Raffles.',
                'guide_pdf_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. SEED DOKUMENTER GOSALI (Tabel: gosali_videos)
        DB::table('gosali_videos')->truncate();
        DB::table('gosali_videos')->insert([
            [
                'title' => 'Teknik Konservasi & Jamasan Pusaka Keris Simbar Kancana',
                'duration' => '10:15',
                'sort_order' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_file_path' => null,
                'thumbnail_path' => 'images/artefak/arca_simbar_kancana.jpg',
                'description' => 'Proses konservasi rutin dan perawatan kimiawi alami minyak warangan untuk menjaga kelestarian bilah keris dan kujang peninggalan Kerajaan.',
                'guide_pdf_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Panday Wesi: Seni Penempaan Kujang & Senjata Kuno Nusantara',
                'duration' => '14:20',
                'sort_order' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_file_path' => null,
                'thumbnail_path' => 'images/artefak/baju_zirah.jpg',
                'description' => 'Eksplorasi teknik penempaan pandai besi tradisional dalam pembuatan tombak, golok, dan kujang khas wilayah Kerajaan Talaga.',
                'guide_pdf_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
