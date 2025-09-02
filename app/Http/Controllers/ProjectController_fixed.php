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
   * Get all projects data - single source of truth for both map and show methods.
   */
  private function getAllProjects()
  {
    return [
      [
        'id' => 1,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT PGN LNG Indonesia',
        'title' => 'FEED Regasification Terminal LNG Jawa Timur',
        'description' => 'FEED for Phase 1 & 2 Short Term LNG Regasification Solution and Filling Station',
        'location' => 'Jawa Timur',
        'latitude' => -7.5360639,
        'longitude' => 112.2384017,
        'year' => '2019'
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
        'latitude' => 0.2933,
        'longitude' => 101.7068,
        'year' => '2019'
      ],
      [
        'id' => 3,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Perusahaan Gas Negara Tbk.',
        'title' => 'Pre-FEED LNG For PLTMG PLN KEPMEN 13',
        'description' => 'PRE FEED Document Dosier for 32 Power plants of cluster Kalimantan, Sulawesi, Maluku, Nusa Tenggara, Papua Utara & Papua Selatan',
        'location' => 'Cluster Kalimantan, Sulawesi, Maluku, Nusa Tenggara, Papua Utara & Papua Selatan',
        'latitude' => -2.5489,
        'longitude' => 118.0149,
        'year' => '2021 - 2022'
      ],
      [
        'id' => 4,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Nusantara Regas',
        'title' => 'SUB-CONSULTANT FOR FSRU JAWA BARAT',
        'description' => 'Menyelesaikan Persyaratan Teknis dan Dokumen Lelang Proyek FSRU. Memberikan Estimasi Teknik untuk FSRU Jawa Barat. Mengembangkan Jadwal Proyek. Membantu/Mendukung Perusahaan selama Seleksi Galangan Kapal (opsional).',
        'location' => 'Jawa Barat',
        'latitude' => -6.9175,
        'longitude' => 107.6191,
        'year' => '2022'
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
        'latitude' => -3.3194,
        'longitude' => 103.9140,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 6,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'PROJECT MANAGEMENT OFFICE (PMO) SUPPORT SERVICES PHR',
        'description' => 'Menyediakan personel, sarana, peralatan, perbekalan transportasi dan kajian penelitian untuk melaksanakan pekerjaan penunjang kegiatan Project Management Office (PMO) di area PT Pertamina Hulu Rokan.',
        'location' => 'Riau',
        'latitude' => 0.2933,
        'longitude' => 101.7068,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 7,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'Medco Energy Pty Ltd',
        'title' => 'EngineeringS PROJECT MANAGEMENT & PROFESSIONAL SERVICE',
        'description' => 'Proyek ini akan menyediakan manajemen teknik, perencanaan, desain, penyusunan, dukungan pengadaan, dukungan konstruksi, manajemen pengendalian bahaya, dan manajemen kualitas. Disiplin teknik dan desain yang dibutuhkan adalah proses, struktural, sipil, mekanik, perpipaan, pipa darat & bawah laut, kelistrikan & instrumentasi, material & korosi.',
        'location' => 'Blok Tarakan, Blok Lematang, Blok Rimau, Blok Sumatera Selatan, Blok Jawa Timur (Sampang, Madura Bangkanai)',
        'latitude' => 3.3017,
        'longitude' => 117.5789,
        'year' => '2020 - 2023'
      ],
      [
        'id' => 8,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'On Going',
        'client' => 'PT. Pertamina Hulu Energy Offshore North West Java (PHE ONWJ)',
        'title' => 'TECHNICAL SERVICES CONTRACT FOR BLANKET ENGINEERING',
        'description' => 'Menyediakan dan melakukan manajemen rekayasa, desain, studi, penyusunan, reproduksi. Mengatur dan menyediakan keahlian dalam bidang manajemen proyek rekayasa, Teknik dan estimasi biaya. Layanan terkait lainnya untuk mendukung dan melaksanakan berbagai proyek pengembangan dan modifikasi dari fasilitas eksisting minyak dan gas milik klien di area Darat & Lepas Pantai Laut Jawa',
        'location' => 'Jakarta',
        'latitude' => -6.2088,
        'longitude' => 106.8456,
        'year' => '2024'
      ],
      [
        'id' => 9,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'On Going',
        'client' => 'PT Kilang Pertamina Internasional',
        'title' => 'Kontrak Payung Jasa Konsultasi Engineering Pendukung Pekerjaan Di PT Kilang Pertamina Internasional 2023 – 2025',
        'description' => 'Kontrak Payung Jasa Konsultasi Engineering Pendukung Pekerjaan',
        'location' => 'Indonesia',
        'latitude' => -6.2088,
        'longitude' => 106.8456,
        'year' => '2023 - 2025'
      ],
      [
        'id' => 10,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Dover Chemical',
        'title' => 'DED UTILITY PIPING & FEEDSTOCK',
        'description' => 'Johnson Matthey Formox AB (Formalin Plant) Sweden, GEA Process Engineering (Paraformaldehyde Plant) Denmark',
        'location' => 'Indonesia',
        'latitude' => -6.2088,
        'longitude' => 106.8456,
        'year' => '2016 - 2017'
      ],
      [
        'id' => 11,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Dover Chemical',
        'title' => 'DED DESAIN SISTEM PERPIPAAN GLYCERIN PLANT',
        'description' => 'DED for OSBL & Feedstock line Piping including ISBL interconnecting line',
        'location' => 'Indonesia',
        'latitude' => -6.2088,
        'longitude' => 106.8456,
        'year' => '2018'
      ],
      [
        'id' => 12,
        'business_sector' => 'Engineering',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Kilang Pertamina Internasional',
        'title' => 'FEED PEMBANGUNAN FASILITAS EXPORT HVO RU IV CILACAP',
        'description' => 'Survey Report Study, FEED, MTO, EPC SOW & EPC Schedule Level III + Cost Estimate & QRA',
        'location' => 'Cilacap',
        'latitude' => -7.7264,
        'longitude' => 109.0081,
        'year' => '2022 - 2023'
      ],
      [
        'id' => 13,
        'business_sector' => 'Engineering',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'PT. Pertamina International Exploration and Production (PT. PIEP)',
        'title' => 'PRODUCTION OPERATION PROFESSIONAL SUPPORT SERVICES',
        'description' => 'Jasa konsultasi dan engineering study untuk Fungsi Operation & Production',
        'location' => 'Indonesia',
        'latitude' => -6.2088,
        'longitude' => 106.8456,
        'year' => '2023'
      ],
      [
        'id' => 14,
        'business_sector' => 'Engineering',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Konsultansi Penyusunan Front End Engineering Design (FEED) Proyek Pengembangan Dan Relokasi Aviation Fuel Terminal Ngurah Rai - Bali',
        'description' => 'Melakukan survei pendahuluan pada lokasi kerja. Melakukan survei pemetaan dan topografi pada lokasi kerja. Melakukan survei tanah termasuk pengetesan di laboratorium pada titik-titik yang ditentukan.',
        'location' => 'Bali',
        'latitude' => -8.4095,
        'longitude' => 115.1889,
        'year' => '2023'
      ],
      [
        'id' => 15,
        'business_sector' => 'Consultant',
        'sector' => 'Refinery & Petrochemical',
        'status' => 'Experience',
        'client' => 'PT Kilang Pertamina Balikpapan',
        'title' => 'PEKERJAAN QA & QC',
        'description' => 'Penyediaan Jasa dalam lingkup pekerjaan pelaksanaan Quality Assurance (QA) & Quality Control (QC) di PT. Kilang Pertamina Balikpapan untuk pekerjaan konstruksi Refinery Development Master Plan RU V Balikpapan dan Lawe Lawe.',
        'location' => 'Balikpapan',
        'latitude' => -1.2379,
        'longitude' => 116.8529,
        'year' => '2023 - 2024'
      ],
      [
        'id' => 16,
        'business_sector' => 'Consultant',
        'sector' => 'Upstream',
        'status' => 'Experience',
        'client' => 'PT Pertamina Hulu Rokan',
        'title' => 'Jasa Pendukung Manajemen Proyek & Jasa Pendukung Manajemen Proyek Lapangan',
        'description' => 'Menyediakan personel sesuai dengan kualifikasi yang dibutuhkan untuk melaksanakan jasa pekerjaan seperti yang tertuang pada kontrak',
        'location' => 'Riau',
        'latitude' => 0.2933,
        'longitude' => 101.7068,
        'year' => '2023 - 2026'
      ],
      [
        'id' => 17,
        'business_sector' => 'Consultant',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Gas',
        'title' => 'Jasa Konsultansi Pengawasan Project Di Fungsi RPD SUMBAGUT Untuk Proyek Anggaran Investasi Tahun (2024-2025)',
        'description' => 'Jasa Management Konstruksi/Project Construction, Jasa Pelaksanaan Inspeksi Project, Jasa Pengawasan Health, Safety & Environment Project/ CSMS, Jasa Pelaksanaan dan Penyelesaian Internal Administration',
        'location' => 'Sumatera Utara',
        'latitude' => 3.5952,
        'longitude' => 98.6722,
        'year' => '2024 - 2025'
      ],
      [
        'id' => 18,
        'business_sector' => 'Inspection',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Studi Inspeksi Berikut Soil Investigasi & Pembuatan Rekomendasi Inspeksi Jalur Pipa Penerimaan Di FT Medan Group (Belawan)',
        'description' => 'Survei jalur pipeline eksisting, Survei topografi, batimetri, dan pemetaan jalur pipeline, Investigasi tanah (soil investigation), Studi konstruktabilitas (constructability study)',
        'location' => 'Sumatera Utara',
        'latitude' => 3.5952,
        'longitude' => 98.6722,
        'year' => '2025'
      ],
      [
        'id' => 19,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'On Going',
        'client' => 'PT Pertamina Patra Niaga',
        'title' => 'Jasa Konsultan Soil Investigation & Desain Pondasi di Regional Jatimbalinus',
        'description' => 'Soil investigation darat dan desain pondasi tanki di 5 lokasi terminal: IT Surabaya (TPLG perak), FT Camplong, FT Sanggaran, FT Badas, AFT Eltari, Soil investigation perairan dan desain platform rumah pompa PMK di FT Reo',
        'location' => 'Jawa Timur - Bali - Nusa Tenggara',
        'latitude' => -7.5360639,
        'longitude' => 112.2384017,
        'year' => '2025'
      ],
      [
        'id' => 20,
        'business_sector' => 'Survey',
        'sector' => 'Downstream',
        'status' => 'Experience',
        'client' => 'RU IV Cilacap',
        'title' => 'Survey-Terminal LNG Regasifikasi LNG RU IV Cilacap',
        'description' => 'Boundary dari Storage & Regasification plan area',
        'location' => 'Cilacap',
        'latitude' => -7.7264,
        'longitude' => 109.0081,
        'year' => '2023'
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

    // Find the current project
    $project = collect($allProjects)->firstWhere('id', (int)$id);
    if (!$project) {
      abort(404);
    }

    // Get other projects (excluding current project)
    $otherProjects = collect($allProjects)->where('id', '!=', (int)$id)->take(6)->values();

    return Inertia::render('Projects/Show', [
      'project' => $project,
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
      'projects' => $this->getAllProjects(),
      'mapSettings' => [
        'center' => [-2.5, 108.0], // Indonesia center coordinates
        'zoom' => 5,
        'style' => 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
      ],
      'filter' => $request->get('filter') // Pass filter parameter to Vue component
    ]);
  }
}
