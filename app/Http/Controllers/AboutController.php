<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
  /**
   * Display the about page.
   */
  public function index()
  {
    return Inertia::render('About', [
      'company' => [
        'founded' => '2015',
        'employees' => '800+',
        'headquarters' => 'Jakarta, Indonesia',
        'affiliation' => 'PT Perusahaan Gas Negara Tbk',
        'establishmentDate' => '20 April 2015',
        'branches' => [
          'Jakarta',
          'Surabaya',
          'Medan',
          'Balikpapan'
        ]
      ],
      'mission' => 'Memberikan layanan engineering end to end mulai dari conceptual study hingga commissioning di sektor Oil & Gas mulai dari upstream, midstream, downstream, powerplant',
      'services' => [
        'End-to-end Engineering Solutions',
        'Conceptual Study to Commissioning',
        'Oil & Gas Industry Expertise',
        'Upstream, Midstream & Downstream',
        'Powerplant Engineering'
      ]
    ]);
  }

  /**
   * Display company history.
   */
  public function history()
  {
    return Inertia::render('About/History', [
      'timeline' => [
        [
          'year' => '1999',
          'title' => 'Company Founded',
          'description' => 'PT Sena was established with a vision to provide excellent engineering services.'
        ],
        [
          'year' => '2005',
          'title' => 'First Major Project',
          'description' => 'Completed our first major infrastructure project in Jakarta.'
        ],
        [
          'year' => '2010',
          'title' => 'Regional Expansion',
          'description' => 'Expanded operations to Surabaya and Medan.'
        ],
        [
          'year' => '2015',
          'title' => 'Technology Innovation',
          'description' => 'Introduced cutting-edge technology solutions.'
        ],
        [
          'year' => '2020',
          'title' => 'Digital Transformation',
          'description' => 'Launched digital engineering platforms.'
        ]
      ]
    ]);
  }
  /**
   * Display organizational structure page.
   */
  public function strukturOrganisasi()
  {
    return Inertia::render('StrukturOrganisasi');
  }

  /**
   * Display shareholding structure page.
   */
  public function kepemilikanSaham()
  {
    return Inertia::render('KepemilikanSaham');
  }
  /**
   * Display certifications and awards page.
   */
  public function sertifikasi()
  {
    return Inertia::render('Sertifikasi', [
      'certificates' => [
        'iso9001' => [
          'title' => 'ISO 9001:2015s',
          'subtitle' => 'Sistem Manajemen Mutu',
          'image' => 'https://previewweb.site/gambarsena/ISO_9001_2015.jpg',
          'status' => 'Valid',
          'type' => 'iso'
        ],
        'iso14001' => [
          'title' => 'ISO 14001:2015',
          'subtitle' => 'Sistem Manajemen Lingkungan',
          'image' => 'https://previewweb.site/gambarsena/ISO_14001_2025.jpg',
          'status' => 'Valid',
          'type' => 'iso'
        ],
        'iso45001' => [
          'title' => 'ISO 45001:2018',
          'subtitle' => 'Sistem Manajemen K3',
          'image' => 'https://previewweb.site/gambarsena/ISO_45001_2018.jpg',
          'status' => 'Valid',
          'type' => 'iso'
        ],
        'iso21500' => [
          'title' => 'ISO 21500:2021',
          'subtitle' => 'Pedoman Manajemen Proyek',
          'image' => 'https://previewweb.site/gambarsena/ISO_21500_2021.jpg',
          'status' => 'Valid',
          'type' => 'iso'
        ],
        'iso37001' => [
          'title' => 'ISO 37001:2016',
          'subtitle' => 'Sistem Manajemen Anti Penyuapan',
          'image' => 'https://previewweb.site/gambarsena/ISO_37001_2016.jpg',
          'status' => 'Valid',
          'type' => 'iso'
        ]
      ],
      'awards' => [
        'best_engineering_2023' => [
          'title' => 'Best Engineering Company 2023',
          'subtitle' => 'Indonesia Oil & Gas Awards',
          'image' => 'https://previewweb.site/gambarsena/award_best_engineering_2023.jpg',
          'status' => 'Valid',
          'type' => 'awards'
        ],
        'safety_excellence_2022' => [
          'title' => 'Safety Excellence Award 2022',
          'subtitle' => 'Zero Accident Achievement',
          'image' => 'https://previewweb.site/gambarsena/award_safety_excellence.jpg',
          'status' => 'Valid',
          'type' => 'awards'
        ],
        'green_company_2024' => [
          'title' => 'Green Company Award 2024',
          'subtitle' => 'Environmental Excellence',
          'image' => 'https://previewweb.site/gambarsena/award_green_company.jpg',
          'status' => 'Valid',
          'type' => 'awards'
        ]
      ]
    ]);
  }

  /**
   * Display policies and commitments page.
   */
  public function kebijakan()
  {
    return Inertia::render('Kebijakan', [
      'policies' => [
        'safety' => [
          'title' => 'Kebijakan Anti Penyuapan',
          'subtitle' => 'Anti-Bribery Policy',
          'image' => 'https://previewweb.site/gambarsena/KebijakanAntiPenyuapan.jpg'
        ],
        'quality' => [
          'title' => 'Kebijakan Mutu K3LL',
          'subtitle' => 'Quality, Health, Safety & Environmental Policy',
          'image' => 'https://previewweb.site/gambarsena/KebijakanMutuK3LL.jpg'
        ],
        'environment' => [
          'title' => 'Komitmen Bersama SENA',
          'subtitle' => 'SENA Joint Commitment',
          'image' => 'https://previewweb.site/gambarsena/KomitmenBersamaSENA.jpg'
        ],
        'integrity' => [
          'title' => 'Komitmen Bersama - Narkoba dan HIV AIDS',
          'subtitle' => 'Drug Free & HIV AIDS Prevention Commitment',
          'image' => 'https://previewweb.site/gambarsena/KomitmenBersamaNarkobadanHIVAids.jpg'
        ],
        'innovation' => [
          'title' => 'Komitmen Kawasan Tanpa Rokok',
          'subtitle' => 'Smoke Free Zone Commitment',
          'image' => 'https://previewweb.site/gambarsena/KomitmenKawasanTanpaRokok.jpg'
        ]
      ]
    ]);
  }

  /**
   * Display annual report page.
   */  public function annualReport()
  {
    return Inertia::render('AnnualReport', [
      'annual_reports' => [
        '2023' => [
          'title' => 'Annual Report 2023',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729998155.jpg',
          'file_url' => '#',
          'year' => '2023',
          'status' => 'latest'
        ],
        '2022' => [
          'title' => 'Annual Report 2022',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729997934.jpg',
          'file_url' => '#',
          'year' => '2022',
          'status' => 'published'
        ],
        '2021' => [
          'title' => 'Annual Report 2021',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729997809.jpg',
          'file_url' => '#',
          'year' => '2021',
          'status' => 'published'
        ],
        '2020' => [
          'title' => 'Annual Report 2020',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729997737.jpg',
          'file_url' => '#',
          'year' => '2020',
          'status' => 'published'
        ],
        '2019' => [
          'title' => 'Annual Report 2019',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729997591.jpg',
          'file_url' => '#',
          'year' => '2019',
          'status' => 'published'
        ],
        '2018' => [
          'title' => 'Annual Report 2018',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1729997498.jpg',
          'file_url' => '#',
          'year' => '2018',
          'status' => 'published'
        ],
        '2017' => [
          'title' => 'Annual Report 2017',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1731291062.jpg',
          'file_url' => '#',
          'year' => '2017',
          'status' => 'published'
        ],
        '2016' => [
          'title' => 'Annual Report 2016',
          'image' => 'https://profile.pt-sena.co.id/upload/image/annualreport_1730268964.jpg',
          'file_url' => '#',
          'year' => '2016',
          'status' => 'published'
        ]
      ],
      'meta' => [
        'title' => 'Annual Report - PT Sena',
        'description' => 'Discover PT Sena annual reports showcasing our achievements, financial performance, and strategic vision.',
        'keywords' => 'annual report, PT Sena, financial report, company performance, annual achievement'
      ]
    ]);
  }
}
