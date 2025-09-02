<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
  /**
   * Display all projects.
   */
  public function index()
  {
    return Inertia::render('Projects/Index', [
      'projects' => [
        [
          'id' => 1,
          'title' => 'Jakarta-Bandung High Speed Rail',
          'category' => 'Transportation Infrastructure',
          'description' => 'High-speed rail connecting Jakarta and Bandung with advanced engineering solutions.',
          'image' => '/images/projects/hsr-jakarta-bandung.jpg',
          'status' => 'Completed',
          'year' => '2023',
          'client' => 'PT Kereta Cepat Indonesia-China'
        ],
        [
          'id' => 2,
          'title' => 'Suramadu Bridge Maintenance',
          'category' => 'Infrastructure Maintenance',
          'description' => 'Comprehensive maintenance and structural assessment of Suramadu Bridge.',
          'image' => '/images/projects/suramadu-bridge.jpg',
          'status' => 'Ongoing',
          'year' => '2024',
          'client' => 'Ministry of Public Works'
        ],
        [
          'id' => 3,
          'title' => 'Jakarta MRT Phase 2',
          'category' => 'Urban Transportation',
          'description' => 'Extension of Jakarta MRT system with advanced engineering and technology.',
          'image' => '/images/projects/jakarta-mrt.jpg',
          'status' => 'In Progress',
          'year' => '2024',
          'client' => 'PT MRT Jakarta'
        ]
      ]
    ]);
  }
  /**
   * Get map projects data - specific data for map display with accurate coordinates.
   */
  private function getMapProjects()
  {
    return [
      // Medan
      [
        'id' => 1,
        'business_sector' => 'Inspection',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Studi Inspeksi Berikut Soil Investigasi & Pembuatan Rekomendasi Inspeksi Jalur Pipa Penerimaan Di FT Medan Group (Belawan)',
        'description' => 'Survei jalur pipeline eksisting, Survei topografi, batimetri, dan pemetaan jalur pipeline, Investigasi tanah (soil investigation), Studi konstruktabilitas (constructability study), Penyusunan engineering alignment sheet darat, Front End Engineering Design (FEED) dan engineering estimate (EE)',
        'location' => 'Medan',
        'latitude' => 3.7846882846244485,
        'longitude' => 98.6943067540404,
        'year' => '2025'
      ],

      // Riau - Proyek 1
      [
        'id' => 2,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Gas',
        'title' => 'Feed Oil Pipeline Rokan',
        'description' => 'Route selection study, Technical Document - FEED, Topography survey, Geotechnical Survey, Engineering Estimate, HAZID HAZOP',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2019'
      ],

      // Riau - Proyek 2
      [
        'id' => 3,
        'business_sector' => 'Consultant',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'Project Management Office (PMO) Support Services PHR',
        'description' => 'Menyediakan personel, sarana, peralatan, perbekalan transportasi dan kajian penelitian untuk melaksanakan pekerjaan penunjang kegiatan Project Management Office (PMO) di area PT Pertamina Hulu Rokan.',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2022 - 2023'
      ],

      // Riau - Proyek 3
      [
        'id' => 4,
        'business_sector' => 'Consultant',
        'sector' => 'Upstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'Jasa Pendukung Manajemen Proyek & Jasa Pendukung Manajemen Proyek Lapangan',
        'description' => 'Menyediakan personel sesuai dengan kualifikasi yang dibutuhkan untuk melaksanakan jasa pekerjaan seperti yang tertuang pada kontrak, personel tersebut juga akan dilengkapi oleh : Kendaraan operasional & bensin, Laptop & Software, Jaringan Internet, Alat Pelindung Diri, Seragam, Representative Office dalam area operasi Perusahaan, Tenaga Administrasi untuk mendukung pekerjaan',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2023 - 2026'
      ],

      // Sumatera Selatan
      [
        'id' => 5,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'Repsol Sakakemang B.V.',
        'title' => 'Provision of Engineering Support Services – Repsol Sakakemang B.V',
        'description' => 'Sakakemang Block and Kaliberau Dalam Discovery',
        'location' => 'Sumatera Selatan',
        'latitude' => -2.1169759873485523,
        'longitude' => 103.91391925562752,
        'year' => '2022 - 2023'
      ],

      // Cilacap
      [
        'id' => 6,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'RU IV Cilacap',
        'title' => 'Feed Pembangunan Fasilitas Export HVO RU IV Cilacap',
        'description' => 'Survey Report Study, FEED, MTO, EPC SOW & EPC Schedule Level III + Cost Estimate & QRA',
        'location' => 'Cilacap',
        'latitude' => -7.699182200939736,
        'longitude' => 108.99861357948878,
        'year' => '2022 - 2023'
      ],

      // Jawa Barat
      [
        'id' => 7,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Nusantara Regas',
        'title' => 'Sub-Consultant for FSRU Jawa Barat',
        'description' => 'Menyelesaikan Persyaratan Teknis dan Dokumen Lelang Proyek FSRU. Memberikan Estimasi Teknik untuk FSRU Jawa Barat. Mengembangkan Jadwal Proyek. Membantu/Mendukung Perusahaan selama Seleksi Galangan Kapal (opsional).',
        'location' => 'Jawa Barat',
        'latitude' => -6.241150690983137,
        'longitude' => 107.59024265862593,
        'year' => '2022'
      ],

      // Jawa Timur - Proyek 1
      [
        'id' => 8,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT PGN LNG Indonesia',
        'title' => 'FEED Regasification Terminal LNG Jawa Timur',
        'description' => 'FEED for Phase 1 & 2 Short Term LNG Regasification Solution and Filling Station',
        'location' => 'Jawa Timur',
        'latitude' => -7.265040937630941,
        'longitude' => 112.7465913753261,
        'year' => '2019'
      ],

      // Jawa Timur - Proyek 2
      [
        'id' => 9,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Jawa Timur',
        'latitude' => -7.265040937630941,
        'longitude' => 112.7465913753261,
        'year' => '2025'
      ],

      // Bali
      [
        'id' => 10,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Bali',
        'latitude' => -8.656374044448656,
        'longitude' => 115.21665961629941,
        'year' => '2025'
      ],

      // Nusa Tenggara Timur
      [
        'id' => 11,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Nusa Tenggara Timur',
        'latitude' => -9.584844387082049,
        'longitude' => 120.23668092379367,
        'year' => '2025'
      ],

      // Balikpapan
      [
        'id' => 12,
        'business_sector' => 'Consultant',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Kilang Pertamina Balikpapan',
        'title' => 'Pekerjaan QA & QC',
        'description' => 'Penyediaan Jasa dalam lingkup pekerjaan pelaksanaan Quality Assurance (QA) & Quality Control (QC) di PT. Kilang Pertamina Balikpapan untuk pekerjaan konstruksi Refinery Development Master Plan RU V Balikpapan dan Lawe Lawe.',
        'location' => 'Balikpapan',
        'latitude' => -1.2192364311448427,
        'longitude' => 116.81691431814295,
        'year' => '2023 - 2024'
      ]
    ];
  }

  /**
   * Get all projects data - single source of truth for both map and show methods.
   */
  private function getAllProjects()
  {
    return [
      [
        'id' => 1,
        'business_sector' => 'Inspection',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Studi Inspeksi Berikut Soil Investigasi & Pembuatan Rekomendasi Inspeksi Jalur Pipa Penerimaan Di FT Medan Group (Belawan)',
        'description' => 'Survei jalur pipeline eksisting, Survei topografi, batimetri, dan pemetaan jalur pipeline, Investigasi tanah (soil investigation), Studi konstruktabilitas (constructability study), Penyusunan engineering alignment sheet darat, Front End Engineering Design (FEED) dan engineering estimate (EE)',
        'location' => 'Medan',
        'latitude' => 3.7846882846244485,
        'longitude' => 98.6943067540404,
        'year' => '2025'
      ],
      [
        'id' => 2,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Gas',
        'title' => 'FEED OIL PIPELINE ROKAN',
        'description' => 'Route selection study, Technical Document - FEED, Topography survey, Geotechnical Survey, Engineering Estimate, HAZID HAZOP',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2019'
      ],
      [
        'id' => 3,
        'business_sector' => 'Consultant',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'PROJECT MANAGEMENT OFFICE (PMO) SUPPORT SERVICES PHR',
        'description' => 'Menyediakan personel, sarana, peralatan, perbekalan transportasi dan kajian penelitian untuk melaksanakan pekerjaan penunjang kegiatan Project Management Office (PMO) di area PT Pertamina Hulu Rokan.',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 4,
        'business_sector' => 'Consultant',
        'sector' => 'Upstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'Jasa Pendukung Manajemen Proyek & Jasa Pendukung Manajemen Proyek Lapangan',
        'description' => 'Menyediakan personel sesuai dengan kualifikasi yang dibutuhkan untuk melaksanakan jasa pekerjaan seperti yang tertuang pada kontrak, personel tersebut juga akan dilengkapi oleh : Kendaraan operasional & bensin, Laptop & Software, Jaringan Internet, Alat Pelindung Diri, Seragam, Representative Office dalam area operasi Perusahaan, Tenaga Administrasi untuk mendukung pekerjaan',
        'location' => 'Riau',
        'latitude' => 0.5655852375032652,
        'longitude' => 100.41058749484624,
        'year' => '2023 - 2026'
      ],
      [
        'id' => 5,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'Repsol Sakakemang B.V.',
        'title' => 'PROVISION OF ENGINEERING SUPPORT SERVICES – REPSOL SAKAKEMANG B.V',
        'description' => 'Sakakemang Block and Kaliberau Dalam Discovery',
        'location' => 'Sumatera Selatan',
        'latitude' => -2.1169759873485523,
        'longitude' => 103.91391925562752,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 6,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'RU IV Cilacap',
        'title' => 'FEED PEMBANGUNAN FASILITAS EXPORT HVO RU IV CILACAP',
        'description' => 'Survey Report Study, FEED, MTO, EPC SOW & EPC Schedule Level III + Cost Estimate & QRA',
        'location' => 'Cilacap',
        'latitude' => -7.699182200939736,
        'longitude' => 108.99861357948878,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 7,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Nusantara Regas',
        'title' => 'SUB-CONSULTANT FOR FSRU JAWA BARAT',
        'description' => 'Menyelesaikan Persyaratan Teknis dan Dokumen Lelang Proyek FSRU. Memberikan Estimasi Teknik untuk FSRU Jawa Barat. Mengembangkan Jadwal Proyek. Membantu/Mendukung Perusahaan selama Seleksi Galangan Kapal (opsional).',
        'location' => 'Jawa Barat',
        'latitude' => -6.241150690983137,
        'longitude' => 107.59024265862593,
        'year' => '2022'
      ],
      [
        'id' => 8,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT PGN LNG Indonesia',
        'title' => 'FEED REGASIFICATION TERMINAL LNG JAWA TIMUR',
        'description' => 'FEED for Phase 1 & 2 Short Term LNG Regasification Solution and Filling Station',
        'location' => 'Jawa Timur',
        'latitude' => -7.265040937630941,
        'longitude' => 112.7465913753261,
        'year' => '2019'
      ],
      [
        'id' => 9,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Jawa Timur',
        'latitude' => -7.265040937630941,
        'longitude' => 112.7465913753261,
        'year' => '2025'
      ],
      [
        'id' => 10,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Bali',
        'latitude' => -8.656374044448656,
        'longitude' => 115.21665961629941,
        'year' => '2025'
      ],
      [
        'id' => 11,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal : IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Nusa Tenggara Timur',
        'latitude' => -9.584844387082049,
        'longitude' => 120.23668092379367,
        'year' => '2025'
      ],
      [
        'id' => 12,
        'business_sector' => 'Consultant',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Kilang Pertamina Balikpapan',
        'title' => 'PEKERJAAN QA & QC',
        'description' => 'Penyediaan Jasa dalam lingkup pekerjaan pelaksanaan Quality Assurance (QA) & Quality Control (QC) di PT. Kilang Pertamina Balikpapan untuk pekerjaan konstruksi Refinery Development Master Plan RU V Balikpapan dan Lawe Lawe.',
        'location' => 'Balikpapan',
        'latitude' => -1.2192364311448427,
        'longitude' => 116.81691431814295,
        'year' => '2023 - 2024'
      ]
    ];
  }

  /**
   * Display specific project details.
   */
  public function show($id)
  {
    // Get all projects data from single source
    $allProjects = $this->getAllProjects();



    // Get other projects (excluding current project)
    $otherProjects = collect($allProjects)->where('id', '!=', (int)$id)->take(6)->values();

    return Inertia::render('Projects/Show', [
      'otherProjects' => $otherProjects
    ]);
  }

  /**
   * Display case studies.
   */
  public function caseStudies()
  {
    return Inertia::render('Projects/CaseStudies', [
      'case_studies' => [
        [
          'title' => 'Innovative Bridge Design in Challenging Terrain',
          'project' => 'Suramadu Bridge Extension',
          'challenge' => 'Designing a bridge extension in earthquake-prone area with marine environment.',
          'solution' => 'Advanced seismic isolation systems and corrosion-resistant materials.',
          'result' => 'Successfully extended bridge life by 50+ years with minimal environmental impact.'
        ],
        [
          'title' => 'Smart Building Integration',
          'project' => 'Jakarta Corporate Tower',
          'challenge' => 'Integrating IoT and smart systems in high-rise construction.',
          'solution' => 'Custom IoT framework with energy management and security systems.',
          'result' => '40% reduction in energy consumption and enhanced building security.'
        ]
      ]
    ]);
  }

  /**
   * Display portfolio.
   */
  public function portfolio()
  {
    return Inertia::render('Projects/Portfolio', [
      'categories' => [
        'Infrastructure' => [
          'count' => 45,
          'featured' => ['Jakarta MRT', 'Suramadu Bridge', 'Toll Road Projects']
        ],
        'Commercial Buildings' => [
          'count' => 78,
          'featured' => ['Shopping Centers', 'Office Towers', 'Mixed-use Developments']
        ],
        'Industrial Facilities' => [
          'count' => 32,
          'featured' => ['Manufacturing Plants', 'Warehouses', 'Processing Facilities']
        ],
        'Residential Projects' => [
          'count' => 125,
          'featured' => ['Housing Complexes', 'Apartments', 'Urban Villages']
        ]
      ]
    ]);
  }
  /**
   * Display projects map with multi-marker locations.
   */
  public function map(Request $request)
  {
    return Inertia::render('Projects/Map', [
      'projects' => $this->getMapProjects(), // Use map-specific data with accurate coordinates
      'mapSettings' => [
        'center' => [-2.5, 108.0], // Indonesia center coordinates
        'zoom' => 5,
        'style' => 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
      ],
      'filter' => $request->get('filter') // Pass filter parameter to Vue component
    ]);
  }
}
