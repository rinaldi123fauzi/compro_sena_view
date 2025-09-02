<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        $news = $this->fetchNewsFromWebsite();

        return Inertia::render('News/IndexNew', [
            'news' => $news
        ]);
    }

    public function show($slug)
    {
        $newsItem = $this->fetchNewsDetail($slug);

        return Inertia::render('News/Show', [
            'newsItem' => $newsItem,
            'slug' => $slug
        ]);
    }
    private function fetchNewsFromWebsite()
    {
        try {            // Data berita PT SENA berdasarkan konten website resmi (diurutkan berdasarkan tanggal terbaru)
            $newsData = [
                [
                    'id' => 5,
                    'title' => 'PT Solusi Energy Nusantara Menyalurkan Energy Kebaikan Melalui Kurban',
                    'slug' => 'pt-solusi-energy-nusantara-menyalurkan-energy-kebaikan-melalui-kurban',
                    'excerpt' => 'Dalam rangka memperingati Hari Raya Idul Adha, PT Solusi Energy Nusantara (SENA) melaksanakan kegiatan penyembelihan hewan kurban sebagai wujud kepedulian kepada masyarakat sekitar dan berbagi kebahagiaan.',
                    'date' => '2025-06-09',
                    'image' => 'https://previewweb.site/gambarsena/5.jpg',
                    'featured' => false,
                    'kategori' => 'news',
                    'content' => 'Jakarta, 9 Juni 2025 – Dalam rangka memperingati Hari Raya Iduladha 1446 H, PT Solusi Energy Nusantara (SENA) melaksanakan kegiatan kurban sebagai wujud kepedulian sosial dan ungkapan rasa syukur perusahaan. Mengusung tema "Menyalurkan Energi Kebaikan Melalui Kurban, Untuk Kerukunan dan Ketakwaan", kegiatan ini dilaksanakan di Kantor Pusat SENA di Jakarta serta di beberapa wilayah proyek, yaitu Medan dan Surabaya.


Di Kantor Pusat Jakarta, SENA menyembelih dua ekor sapi. Daging kurban kemudian didistribusikan kepada karyawan dan masyarakat di sekitar lingkungan kantor. Sementara itu, di Medan dan Surabaya, masing-masing dilaksanakan penyembelihan satu ekor kambing yang juga dibagikan kepada warga sekitar.

Melalui kegiatan ini, SENA berharap dapat menyalurkan energi kebaikan yang membawa manfaat dan keberkahan, tidak hanya bagi para penerima daging kurban, tetapi juga bagi seluruh insan SENA. Kegiatan ini merupakan bagian dari komitmen sosial perusahaan untuk terus hadir dan berbagi dengan sesama, mempererat kerukunan, serta meningkatkan ketakwaan, khususnya di momen penuh makna seperti Iduladha.'
                ],
                [
                    'id' => 4,
                    'title' => 'SENA\'S 10Th Anniversary, "Leading Change Living the Transformat10n"',
                    'slug' => 'sena-10th-anniversary-leading-change-living-the-transformation',
                    'excerpt' => 'PT Solusi Energy Nusantara (SENA) melaksanakan perayaan ulang tahunnya yang ke-10 di GOR PGN Daan Mogot, Jakarta Barat dengan tema "Leading Change Living The Transformation".',
                    'date' => '2025-05-08',
                    'image' => 'https://previewweb.site/gambarsena/4.jpg',
                    'featured' => true,
                    'kategori' => 'news',
                    'content' => 'PT Solusi Energy Nusantara resmi menutup kegiatan rangkaian kegiatan Bulan K3 Nasional 2025 melalui Closing Ceremony Bulan K3 yang diadakan di GOR PGN, Daan Mogot pada Jumat, 28 Februari 2025. Acara ini dihadiri oleh seluruh karyawan dan manajemen, dengan tema utama yang mengusung "Wujudkan Perwira Pertamina yang Unggul dan Berketerampilan HSSE untuk mendukung Bisnis Perusahaan yang Berkelanjutan".

Sebagai bagian dari perayaan Bulan K3 Nasional, SENA telah melaksanakan berbagai kegiatan seperti Webinar Series, Lomba Poster & Video, Cerdas Cermat, Lose Weight serta Senam Bersama selama bulan Januari hingga Februari, adapun webinar yang dilaksanakan ialah tentang keselamatan kerja, pelatihan pertolongan pertama, pemeriksaan kesehatan rutin, serta kegiatan penguatan budaya K3 di seluruh lini perusahaan. Acara penutupan ini menjadi puncak dari serangkaian kegiatan yang bertujuan untuk meningkatkan kesadaran dan pemahaman tentang pentingnya aspek kesehatan dan keselamatan di tempat kerja.

Acara penutupan dimeriahkan dengan sesi Talkshow Kesehatan bertajuk "Cegah dan Kendalikan Obesitas dengan Gizi Seimbang", yang menghadirkan narasumber ahli, dr. Liliana, MBBS, M.Gizi, Sp.GK, seorang spesialis gizi klinik. Dalam sesi ini, dr. Liliana memberikan wawasan mengenai pentingnya pola makan yang sehat dan seimbang untuk mencegah obesitas, yang bisa berisiko menyebabkan berbagai masalah kesehatan, terutama bagi para pekerja yang memiliki mobilitas tinggi dan tekanan kerja yang besar. Dan beliau juga memberikan tips mengenai asupan gizi yang tepat dan bagaimana mengatur pola makan yang baik meski dengan gaya hidup yang sibuk.

Dan puncak dari rangkaian acara ini adalah pengumuman pemenang kompetisi Bulan K3 Nasional Tahun 2025. Para karyawan SENA yang berhasil menjadi pemenang tidak hanya mendapatkan penghargaan, tetapi juga menjadi inspirasi bagi karyawan yang lainnya.'
                ],
                [
                    'id' => 3,
                    'title' => 'SENA Innovation Award : Ciptakan Budaya Inovasi, Kreativitas dan Solutif',
                    'slug' => 'sena-innovation-award-ciptakan-budaya-inovasi-kreativitas-solutif',
                    'excerpt' => 'Divisi SDM PT Solusi Energy Nusantara (SENA) mengadakan pelaksanaan Innovation Award dan Sayembara Karya Tulis Ide Kreatif Tahun 2025, sebagai bentuk apresiasi terhadap insan SENA yang terus menciptakan ide-ide brilian dan solutif.',
                    'date' => '2025-04-24',
                    'image' => 'https://previewweb.site/gambarsena/3.jpg',
                    'featured' => false,
                    'kategori' => 'news',
                    'content' => 'Jakarta, 22-24 April 2025 - Sebagai perusahaan yang bergerak di bidang jasa engineering, SENA terus berkomitmen untuk mendorong budaya inovasi dan kreativitas di lingkungan kerja. Dalam rangka meningkatkan semangat kreatifitas dan inovatif karyawan serta meningkatkan efektivitas dan efisiensi proses kerja melalui proses perbaikan secara berkelanjutan, Divisi SDM PT Solusi Energy Nusantara (SENA) mengadakan pelaksanaan Innovation Award dan Sayembara Karya Tulis Ide Kreatif Tahun 2025, sebagai bentuk apresiasi terhadap insan SENA yang terus menciptakan ide-ide brilian dan solutif dalam mendukung kemajuan perusahaan.

Ketentuan seleksi finalis di kategori Innovation Award diserahkan kepada masing-masing Kepala Satuan Kerja dengan persetujuan dari Direktorat terkait; Inovasi yang dikirimkan adalah inovasi yang diimplementasikan di Satuan Kerjanya; Ide kreatif yang dikirimkan adalah ide yang masih belum ada implementasinya; Presentasi materi inovasi; Fit and Proper Test oleh Tim Juri.

Kegiatan ini bertujuan untuk menumbuhkan semangat berpikir kritis, kreatif, dan inovatif dalam menyelesaikan tantangan di dunia engineering. Dari berbagai proposal dan tulisan yang masuk, tim juri yang terdiri dari jajaran manajemen dan Kepala Divisi telah melakukan penilaian berdasarkan aspek orisinalitas, relevansi, implementabilitas, dan dampak terhadap operasional perusahaan.'
                ],
                [
                    'id' => 2,
                    'title' => 'Safari Ramadan PT Solusi Energy Nusantara 2025 "Berbagi Kasih untuk Anak Yatim dan Dhuafa"',
                    'slug' => 'safari-ramadan-pt-solusi-energy-nusantara-2025-berbagi-kasih-anak-yatim-dhuafa',
                    'excerpt' => 'Dalam rangka menyambut bulan suci Ramadan, PT Solusi Energy Nusantara (SENA) menggelar kegiatan Safari Ramadan dengan tujuan mempererat hubungan antar individu dan memberikan santunan kepada anak yatim dan dhuafa.',
                    'date' => '2025-03-20',
                    'image' => 'https://previewweb.site/gambarsena/2.jpg',
                    'featured' => false,
                    'kategori' => 'news',
                    'content' => 'Dalam rangka menyambut bulan suci Ramadan, PT Solusi Energy Nusantara (SENA) menggelar kegiatan Safari Ramadan. Safari Ramadan merupakan kegiatan yang dilakukan dengan tujuan untuk mempererat hubungan antar individu, baik di dalam lingkungan perusahaan, komunitas, atau masyarakat umum. Kegiatan Safari Ramadan SENA tahun ini diisi dengan acara buka puasa bersama sekaligus memberikan santunan kepada anak yatim, persis sama dengan tahun-tahun sebelumnya.

Acara Safari Ramadan kali ini dilakukan di beberapa kota, diantaranya dengan Panti Asuhan Putra Muhammadiyah di Medan, Panti Asuhan Cahaya Insani di Surabaya (19/03/25), dan Pondok Yatim & Dhuafa yang dinaungi Yayasan Amal Sholeh Sejahtera, Kembangan, Jakarta Barat (20/03/25).

Safari Ramadan SENA 2025 dimulai dengan rangkaian kegiatan yang diisi dengan buka puasa bersama anak-anak yatim serta memberikan santunan kepada mereka. Kegiatan ini bertujuan untuk menumbuhkan rasa kepedulian terhadap sesama serta mempererat tali silaturahim antar sesama umat muslim di bulan yang penuh berkah ini.

Sementara di Jakarta, SENA mengundang anak yatim dari Pondok Yatim & Dhuafa Yayasan Amal Sholeh Sejahtera, Kembangan, Jakarta Barat untuk mengadakan buka puasa bersama di Kantor SENA Daan Mogot, pada 20 Maret 2025. Dalam acara kegiatan buka puasa bersama ini, ada pemberian santunan bagi anak-anak yatim dan dhuafa. Kegiatan ini tak hanya memberi manfaat dalam bentuk materi, tetapi juga menumbuhkan semangat kebersamaan dan mempererat hubungan antara berbagai pihak yang peduli akan sesama.

SENA berharap bahwa kegiatan Safari Ramadan ini dapat terus berlangsung setiap tahunnya, membawa manfaat yang lebih besar, serta memberikan dampak positif dalam kehidupan anak-anak yatim dan dhuafa di seluruh Indonesia. Kegiatan Safari Ramadan ini merupakan salah satu bentuk nyata komitmen SENA dalam membangun kepedulian sosial dan berbagi kepada sesama, terutama kepada mereka yang kurang beruntung.'
                ],
                [
                    'id' => 1,
                    'title' => 'PT Solusi Energy Nusantara Sukses Laksanakan Bulan K3 Nasional 2025',
                    'slug' => 'pt-solusi-energy-nusantara-sukses-laksanakan-bulan-k3-nasional-2025',
                    'excerpt' => 'PT Solusi Energy Nusantara resmi menutup kegiatan rangkaian kegiatan Bulan K3 Nasional 2025 melalui Closing Ceremony Bulan K3 yang diadakan di GOR PGN, Daan Mogot pada Jumat, 28 Februari 2025.',
                    'date' => '2025-02-28',
                    'image' => 'https://previewweb.site/gambarsena/1.jpg',
                    'featured' => true,
                    'kategori' => 'news',
                    'content' => 'PT Solusi Energy Nusantara resmi menutup kegiatan rangkaian kegiatan Bulan K3 Nasional 2025 melalui Closing Ceremony Bulan K3 yang diadakan di GOR PGN, Daan Mogot pada Jumat, 28 Februari 2025. Acara ini dihadiri oleh seluruh karyawan dan manajemen, dengan tema utama yang mengusung "Wujudkan Perwira Pertamina yang Unggul dan Berketerampilan HSSE untuk mendukung Bisnis Perusahaan yang Berkelanjutan".

Sebagai bagian dari perayaan Bulan K3 Nasional, SENA telah melaksanakan berbagai kegiatan seperti Webinar Series, Lomba Poster & Video, Cerdas Cermat, Lose Weight serta Senam Bersama selama bulan Januari hingga Februari, adapun webinar yang dilaksanakan ialah tentang keselamatan kerja, pelatihan pertolongan pertama, pemeriksaan kesehatan rutin, serta kegiatan penguatan budaya K3 di seluruh lini perusahaan. Acara penutupan ini menjadi puncak dari serangkaian kegiatan yang bertujuan untuk meningkatkan kesadaran dan pemahaman tentang pentingnya aspek kesehatan dan keselamatan di tempat kerja.

Acara penutupan dimeriahkan dengan sesi Talkshow Kesehatan bertajuk "Cegah dan Kendalikan Obesitas dengan Gizi Seimbang", yang menghadirkan narasumber ahli, dr. Liliana, MBBS, M.Gizi, Sp.GK, seorang spesialis gizi klinik. Dalam sesi ini, dr. Liliana memberikan wawasan mengenai pentingnya pola makan yang sehat dan seimbang untuk mencegah obesitas, yang bisa berisiko menyebabkan berbagai masalah kesehatan, terutama bagi para pekerja yang memiliki mobilitas tinggi dan tekanan kerja yang besar. Dan beliau juga memberikan tips mengenai asupan gizi yang tepat dan bagaimana mengatur pola makan yang baik meski dengan gaya hidup yang sibuk.

Dan puncak dari rangkaian acara ini adalah pengumuman pemenang kompetisi Bulan K3 Nasional Tahun 2025. Para karyawan SENA yang berhasil menjadi pemenang tidak hanya mendapatkan penghargaan, tetapi juga menjadi inspirasi bagi karyawan yang lainnya.'
                ]
            ];

            return $newsData;
        } catch (\Exception $e) {
            // Fallback ke data dummy jika gagal fetch
            return [];
        }
    }
    private function fetchNewsDetail($slug)
    {
        $allNews = $this->fetchNewsFromWebsite();

        $newsItem = collect($allNews)->firstWhere('slug', $slug);

        if (!$newsItem) {
            return [
                'title' => 'Berita Tidak Ditemukan',
                'content' => 'Artikel berita yang Anda cari tidak dapat ditemukan.',
                'date' => now()->format('Y-m-d'),
                'image' => null,
                'excerpt' => 'Artikel tidak ditemukan'
            ];
        }

        // Ensure content exists, if not provide default content based on excerpt
        if (!isset($newsItem['content'])) {
            $newsItem['content'] = $newsItem['excerpt'] . "\n\nKonten lengkap artikel ini sedang dalam proses pengembangan. Untuk informasi lebih detail, silakan hubungi tim kami melalui halaman kontak.";
        }

        return $newsItem;
    }

    public function getLatestNews($limit = 3)
    {
        $news = $this->fetchNewsFromWebsite();
        return array_slice($news, 0, $limit);
    }
}
