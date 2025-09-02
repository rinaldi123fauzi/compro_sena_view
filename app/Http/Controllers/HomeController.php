<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
  /**
   * Display the home page.
   */
  public function index()
  {    // Get latest news data same as fetchNewsFromWebsite
    $newsData = [
      [
        'id' => 4,
        'title' => 'SENA\'s 10Th Anniversary, "Leading Change Living the Transformat10n"',
        'slug' => 'sena-10th-anniversary-leading-change-living-the-transformation',
        'excerpt' => 'PT Solusi Energy Nusantara (SENA) melaksanakan perayaan ulang tahunnya yang ke-10 di GOR PGN Daan Mogot, Jakarta Barat dengan tema "Leading Change Living The Transformation".',
        'date' => '2025-05-08',
        'image' => 'https://previewweb.site/gambarsena/4.jpg',
        'featured' => true,
        'kategori' => 'news'
      ],
      [
        'id' => 3,
        'title' => 'SENA Innovation Award : Ciptakan Budaya Inovasi, Kreativitas dan Solutif',
        'slug' => 'sena-innovation-award-ciptakan-budaya-inovasi-kreativitas-solutif',
        'excerpt' => 'Divisi SDM PT Solusi Energy Nusantara (SENA) mengadakan pelaksanaan Innovation Award dan Sayembara Karya Tulis Ide Kreatif Tahun 2025, sebagai bentuk apresiasi terhadap insan SENA yang terus menciptakan ide-ide brilian dan solutif.',
        'date' => '2025-04-24',
        'image' => 'https://previewweb.site/gambarsena/3.jpg',
        'featured' => false,
        'kategori' => 'news'
      ],
      [
        'id' => 2,
        'title' => 'Safari Ramadan PT Solusi Energy Nusantara 2025 "Berbagi Kasih untuk Anak Yatim dan Dhuafa"',
        'slug' => 'safari-ramadan-pt-solusi-energy-nusantara-2025-berbagi-kasih-anak-yatim-dhuafa',
        'excerpt' => 'Dalam rangka menyambut bulan suci Ramadan, PT Solusi Energy Nusantara (SENA) menggelar kegiatan Safari Ramadan dengan tujuan mempererat hubungan antar individu dan memberikan santunan kepada anak yatim dan dhuafa.',
        'date' => '2025-03-20',
        'image' => 'https://previewweb.site/gambarsena/2.jpg',
        'featured' => false,
        'kategori' => 'news'
      ],
      [
        'id' => 1,
        'title' => 'PT Solusi Energy Nusantara Sukses Laksanakan Bulan K3 Nasional 2025',
        'slug' => 'pt-solusi-energy-nusantara-sukses-laksanakan-bulan-k3-nasional-2025',
        'excerpt' => 'PT Solusi Energy Nusantara resmi menutup kegiatan rangkaian kegiatan Bulan K3 Nasional 2025 melalui Closing Ceremony Bulan K3 yang diadakan di GOR PGN, Daan Mogot pada Jumat, 28 Februari 2025.',
        'date' => '2025-02-28',
        'image' => 'https://previewweb.site/gambarsena/1.jpg',
        'featured' => true,
        'kategori' => 'news'
      ]
    ];

    // Get latest 4 news for homepage (already sorted by date desc)
    $latestNews = array_slice($newsData, 0, 4);

    return Inertia::render('Welcome', [
      'stats' => [
        'users' => '1,000+',
        'projects' => '500+',
        'satisfaction' => '99%'
      ],
      'news' => $latestNews,
      'meta' => [
        'title' => 'PT Sena - Engineering Excellence',
        'description' => 'Leading engineering solutions provider with innovative technology and expert services.',
        'keywords' => 'engineering, technology, construction, infrastructure, PT Sena'
      ]
    ]);
  }

  /**
   * Get company statistics for API endpoints.
   */
  public function getStats()
  {
    return response()->json([
      'users' => '1,000+',
      'projects' => '500+',
      'satisfaction' => '99%',
      'years_experience' => '25+',
      'countries' => '10+',
      'employees' => '500+'
    ]);
  }
}
