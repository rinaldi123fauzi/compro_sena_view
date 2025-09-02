<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CapabilityController extends Controller
{
  /**
   * Display the capability page.
   */
  public function index(): Response
  {
    return Inertia::render('Capability/Index', [
      'capabilities' => [
        'engineering' => [
          'title' => 'Engineering',
          'description' => 'SENA memiliki keahlian menyusun dokumen engineering design untuk semua tahapan engineering yang dibutuhkan.',
          'services' => [
            'Conceptual - Feasibility Study',
            'Pre Front End Engineering Design (Pre Feed)',
            'Front End Engineering Design (FEED)',
            'Detail Engineering Design (DED)',
            'Hazard and Operability (HAZOP) Study',
            'Hazard Identification (HAZID) Study',
            'Design Review',
            'Flow Assurance Study'
          ]
        ],
        'inspections' => [
          'title' => 'Inspections',
          'description' => 'SENA memiliki keahlian dalam inspeksi dan pengujian teknis, integrity serta pekerjaan pasca operasi.',
          'duringConstruction' => [
            'Welding and Coating Inspection',
            'Material Testing & Inspection',
            'Non-Destructive Testing (Conventional & Advance)',
            'Destructive Testing'
          ],
          'postOperation' => [
            'Pipeline and Facility Inspection & Assessment',
            'Intelligent Pigging',
            'Reliability Study',
            'Risk Assessment and Mitigation',
            'Risk Based Inspection',
            'Fitness For Services',
            'Remaining Life Assessment',
            'Failure Analysis',
            'External Corrosion Direct Assessment (CIPS, DCVG, PCM)',
            'Geohazard Assessment',
            'Jetty Assessment (Non Destructive & Destructive Test)',
            'Asset Integrity Management System (AIMS)'
          ]
        ],
        'survey' => [
          'title' => 'Survey',
          'description' => 'Comprehensive surveying and mapping services utilizing advanced technology for precise data collection and analysis',
          'services' => [
            'GIS Mapping',
            'Topographic Survey',
            'ROV Survey',
            'Bathymetry Survey',
            'Soil Investigation',
            'Air Photogrammetry',
            '3D Laser Scanning',
            'MetOcean'
          ]
        ],
        'consultant' => [
          'title' => 'Consultancy',
          'description' => 'SENA memiliki layanan di bidang konsultansi teknis baik yang terkait dengan konstruksi dan non konstruksi.',
          'services' => [
            'Project Management Consultancy (PMC)',
            'Technical Assistance Services (TAS)',
            'Studi/Kajian Teknis',
            'Perhitungan Harga Satuan / Market Survey',
            'Due Diligence'
          ]
        ]
      ]
    ]);
  }

  /**
   * Display the disiplin page.
   */
  public function disiplin(): Response
  {
    return Inertia::render('Capability/Disiplin', [
      'disciplines' => [
        'piping_mechanical' => [
          'title' => 'Piping & Mechanical',
          'description' => '',
          'icon' => 'fas fa-cogs',
          'services' => '',
          'expertise' => [
            'ASME B31.3 Process Piping',
            'API Standards Compliance',
            'Equipment Specification',
            'Material Selection',
            'Pipe Support Design',
            'Expansion Joint Design',
            'Stress Analysis Software',
            'AutoCAD Plant 3D',
            'CAESAR II',
            'PDMS/E3D Modeling'
          ],
          'technologies' => [
            'AutoCAD Plant 3D',
            'PDMS/E3D',
            'CAESAR II',
            'PV Elite',
            'HTRI',
            'ASPEN Plus',
            'SolidWorks',
            'Inventor'
          ],
          'projects' => [
            'Oil & Gas Processing Facilities',
            'Petrochemical Plants',
            'Power Generation Plants',
            'LNG Facilities',
            'Refineries',
            'Chemical Processing Plants'
          ]
        ],
        'pipeline' => [
          'title' => 'Pipeline',
          'description' => '',
          'icon' => 'fas fa-road',
          'services' => '',
          'expertise' => [
            'ASME B31.4 & B31.8 Standards',
            'DNV & API Pipeline Standards',
            'Route Optimization',
            'Environmental Compliance',
            'Geotechnical Considerations',
            'Corrosion Protection',
            'Pressure Testing Procedures',
            'Pipeline Modeling',
            'Risk Assessment',
            'Integrity Management Systems'
          ],
          'technologies' => [
            'PIPESIM',
            'OLGA',
            'AutoCAD Civil 3D',
            'GIS Mapping Software',
            'ROSEN Pipeline Software',
            'Pipeline Studio',
            'Atmos Pipeline',
            'SynerGEE Gas'
          ],
          'projects' => [
            'Cross Country Oil Pipelines',
            'Natural Gas Distribution',
            'Subsea Pipeline Systems',
            'Gathering Systems',
            'Product Pipelines',
            'Water Injection Systems'
          ]
        ],
        'electrical' => [
          'title' => 'Electrical',
          'description' => '',
          'icon' => 'fas fa-bolt',
          'services' => 'Diplin Electrical bergerak di bidang engineering consultancy, khususnya untuk industri minyak dan gas. Fokus utamanya adalah pada pengembangan dokumen teknik kelistrikan dari tahap konseptual hingga detail engineering, dengan mengacu pada standar nasional dan internasional seperti IEC, IEEE, NEC, dan API.<br><br>

          Tahapan engineering kelistrikan terdiri dari Conceptual Design, FEED, dan DED. Pada tahap Conceptual Design, disusun konsep dasar sistem kelistrikan seperti kebutuhan daya dan konfigurasi awal untuk studi kelayakan. FEED menyajikan detail teknis lebih rinci seperti load list, sizing kabel, dan spesifikasi peralatan sebagai dasar estimasi biaya dan persiapan konstruksi. Tahap DED menghasilkan dokumen final yang lengkap dan siap digunakan di lapangan, seperti diagram satu garis akhir, layout peralatan, jalur kabel, dan perhitungan sistem tervalidasi.<br><br>

          Disiplin Electrical SENA terdapat 2 sosok andalan yaitu Agung Arief Prabowo menjabat sebagai Lead Electrical Engineer. Berbekal pengalaman lebih dari 13 tahun di bidang teknik kelistrikan untuk sektor migas dan industri, ia memimpin penyusunan dokumen teknis dan koordinasi antardisiplin, seperti pada proyek FEED Pipa Gas Tegal–Cilacap. Sementara itu, Jongguran David Maruli Tua Simbolon, yang telah bergabung sejak 2018, memiliki pengalaman lebih dari 15 tahun dalam desain sistem tenaga, studi teknis, dan spesifikasi peralatan. Ia telah menangani berbagai proyek strategis seperti FEED Terminal LNG, fasilitas HVO, dan DED fasilitas RO di Balikpapan. Keduanya berperan penting dalam menjamin kualitas dan keandalan desain kelistrikan di setiap proyek SENA. 
          ',
          'expertise' => [
            'IEEE Standards',
            'IEC Standards',
            'National Electrical Code',
            'Power System Studies',
            'Electrical Safety',
            'Energy Efficiency',
            'Arc Flash Analysis',
            'Harmonic Analysis',
            'Motor Starting Studies',
            'Protective Device Coordination'
          ],
          'technologies' => [
            'ETAP',
            'SKM Power Tools',
            'CYME',
            'AutoCAD Electrical',
            'EPLAN',
            'Bentley Substation',
            'DIgSILENT PowerFactory',
            'PSCAD'
          ],
          'projects' => [
            'Industrial Power Distribution',
            'Substation Design',
            'Solar Power Systems',
            'Emergency Power Systems',
            'Motor Control Systems',
            'Lighting Systems'
          ]
        ],
        'civil_structure' => [
          'title' => 'Civil & Structure',
          'description' => 'Nem',
          'icon' => 'fas fa-building',
          'services' => 'Disiplin Civil dalam tahap Front-End Engineering Design (FEED) berfokus pada perencanaan awal proyek secara teknis dan konseptual sebelum memasuki fase EPC. Kegiatan mencakup survei topografi, investigasi tanah, perancangan pondasi awal, layout struktur, analisis struktur utama, serta perencanaan sistem drainase dan akses konstruksi. Dokumen yang dihasilkan meliputi design criteria, preliminary drawings, material take-off, dan laporan teknis yang menjadi acuan penting dalam menentukan kelayakan proyek dari sisi teknis, biaya, dan waktu.  
          <br><br>
          Ir. Ismail merupakan seorang pakar di bidang teknik sipil dan struktur dengan pengalaman lebih dari 25 tahun di berbagai proyek nasional dan internasional. Ia telah menduduki berbagai posisi penting, seperti Specialist Civil/Structural Engineer, Lead Engineer, hingga Head of Civil Department. Pengalamannya mencakup proyek infrastruktur, pembangkit listrik, kilang minyak dan gas (termasuk LNG), petrokimia, industri berat, distribusi air, hingga bangunan struktur baja. Ir. Ismail bertanggung jawab dalam desain rinci struktur, evaluasi teknis penawaran, estimasi biaya konstruksi, pengawasan fabrikasi material, serta pemberian jawaban teknis di lapangan selama fase konstruksi. Ia juga aktif dalam koordinasi dengan subkontraktor, tinjauan gambar teknik, persetujuan material, hingga penyelesaian laporan teknis seperti NCR dan QC Surveillance. Keahliannya didukung pemahaman mendalam terhadap berbagai standar internasional seperti ASCE, AISC, API, ACI, UBC, hingga standar Australia dan Jepang. ',
          'expertise' => [
            'ACI Standards',
            'AISC Steel Construction',
            'Seismic Design',
            'Wind Load Analysis',
            'Geotechnical Engineering',
            'Construction Materials',
            'Soil Mechanics',
            'Structural Dynamics',
            'Foundation Design',
            'Reinforced Concrete Design'
          ],
          'technologies' => [
            'SAP2000',
            'ETABS',
            'STAAD Pro',
            'AutoCAD Civil 3D',
            'Revit Structure',
            'PLAXIS',
            'SAFE',
            'CSiBridge'
          ],
          'projects' => [
            'Industrial Buildings',
            'Processing Facilities',
            'Control Buildings',
            'Warehouses',
            'Equipment Foundations',
            'Access Roads'
          ]
        ],
        'offshore_marine' => [
          'title' => 'Offshore & Marine',
          'description' => '',
          'icon' => 'fas fa-ship',
          'services' => '',
          'expertise' => [
            'API RP 2A Standards',
            'DNV Offshore Standards',
            'Wave & Current Analysis',
            'Marine Corrosion',
            'Subsea Technology',
            'Installation Engineering',
            'Dynamic Analysis',
            'Fatigue Assessment',
            'Environmental Loading',
            'Marine Operations'
          ],
          'technologies' => [
            'SACS',
            'ANSYS AQWA',
            'OrcaFlex',
            'WAMIT',
            'SESAM',
            'AutoCAD Plant 3D',
            'Bentley SACS',
            'MOSES'
          ],
          'projects' => [
            'Fixed Offshore Platforms',
            'Floating Production Units',
            'Subsea Systems',
            'Marine Terminals',
            'Offshore Wind Foundations',
            'Jacket Structures'
          ]
        ],
        'instrument_control' => [
          'title' => 'Instrument & Control',
          'description' => '',
          'icon' => 'fas fa-microchip',
          'services' => 'Instrument dan control adalah sebuah bidang ilmu teknik yang mempelajari prinsip pengukuran (instrumentation) dan pengendalian (control) variabel-variabel proses dalam suatu sistem atau proses. Bidang ini menggabungkan dua disiplin utama yaitu teknik instrumentasi yang berfokus pada pengukuran variabel proses dan teknik kontrol yang menerapkan teori kontrol untuk mendesain sistem sesuai dengan perilaku yang diinginkan. Tujuan utamanya adalah untuk memastikan bahwa suatu proses berjalan dengan aman, efisien, stabil, dan menghasilkan produk dengan kualitas yang diinginkan.  
          <br><br>
          Instrumentasi adalah bidang multidisiplin yang berperan penting dalam mendeteksi dan mengukur variabel proses seperti suhu, tekanan, level, dan aliran, khususnya di industri migas. Bidang ini menggabungkan teknologi elektronik, optik, pneumatik, dan mekanik dengan dasar ilmu fisika untuk menghasilkan sistem pengukuran yang akurat dan efisien. Dalam tahapan proyek, proses dimulai dari Conceptual Design untuk merumuskan ide utama dan kelayakan teknis, dilanjutkan ke Basic Engineering/FEED untuk membuat rencana teknis yang lebih rinci, lalu ke DED (Detailed Engineering Design) untuk menyiapkan dokumen konstruksi lengkap. Sepanjang prosesnya, PMC (Project Management Consultant) berperan dalam mengawasi pelaksanaan proyek agar sesuai spesifikasi, waktu, dan anggaran.  
          <br><br>
          Tim Instrumentasi SENA diperkuat oleh tiga engineer senior dengan pengalaman lebih dari 13 tahun. Dandy Harris Firdianda, lulusan Teknik Fisika ITS, telah menangani berbagai proyek dalam dan luar negeri di bidang desain detail, konseptual, dan manajemen proyek. Fajar Trapsilo, lulusan Teknik Elektro UI, juga berpengalaman luas di proyek-proyek dalam negeri dengan fokus pada perancangan dan pengawasan teknis. Sementara itu, Ayu Laszrya, lulusan Teknik Fisika ITS, memiliki keahlian serupa dan konsisten berkontribusi dalam berbagai tahapan proyek, dari konseptual hingga pengawasan pelaksanaan. Ketiganya menjadi pilar utama dalam memastikan kualitas dan keandalan sistem instrumentasi di setiap proyek SENA. ',
          'expertise' => [
            'ISA Standards',
            'IEC 61511 SIL',
            'Process Control',
            'Industrial Networks',
            'Safety Systems',
            'Cybersecurity',
            'Functional Safety',
            'Control Loop Tuning',
            'Advanced Process Control',
            'Batch Control Systems'
          ],
          'technologies' => [
            'Honeywell DCS',
            'Emerson DeltaV',
            'Schneider Electric',
            'Siemens PCS7',
            'Rockwell Automation',
            'Yokogawa CENTUM',
            'ABB System 800xA',
            'GE iFIX'
          ],
          'projects' => [
            'Oil & Gas Control Systems',
            'Chemical Process Control',
            'Power Plant Automation',
            'Water Treatment Systems',
            'Manufacturing Automation',
            'Safety Systems'
          ]
        ],
        'process_safety' => [
          'title' => 'Process & Process Safety',
          'description' => '',
          'icon' => 'fas fa-shield-alt',
          'services' => '',
          'expertise' => [
            'Process Safety Standards',
            'HAZOP Methodology',
            'Quantitative Risk Assessment',
            'Process Simulation Software',
            'Safety Integrity Levels',
            'Incident Investigation',
            'Bow-tie Analysis',
            'Layer of Protection Analysis',
            'Fault Tree Analysis',
            'Event Tree Analysis'
          ],
          'technologies' => [
            'ASPEN HYSYS',
            'ASPEN Plus',
            'PHAST',
            'ALOHA',
            'DNV SAFETI',
            'Honeywell UniSim',
            'AVEVA PRO/II',
            'Bentley AutoPIPE'
          ],
          'projects' => [
            'Process Safety Studies',
            'Hazard Analysis',
            'Emergency Response Plans',
            'Safety System Design',
            'Risk Management',
            'Compliance Audits'
          ]
        ]
      ]
    ]);
  }

  /**
   * Display the software and equipment page.
   */
  public function softwareEquipment(): Response
  {
    return Inertia::render('Capability/SoftwareEquipment', [
      'softwareImages' => [
        'https://previewweb.site/gambarsena/softwaresena/ArcGIS.png',
        'https://previewweb.site/gambarsena/softwaresena/AutoCAD.png',
        'https://previewweb.site/gambarsena/softwaresena/Autopipe.png',
        'https://previewweb.site/gambarsena/softwaresena/CaesarII.png',
        'https://previewweb.site/gambarsena/softwaresena/ETAP.png',
        'https://previewweb.site/gambarsena/softwaresena/HYSYS.png',
        'https://previewweb.site/gambarsena/softwaresena/Instrucalc.png',
        'https://previewweb.site/gambarsena/softwaresena/MicrosoftProject.png',
        'https://previewweb.site/gambarsena/softwaresena/OLGA.png',
        'https://previewweb.site/gambarsena/softwaresena/PipeDataPro.png',
        'https://previewweb.site/gambarsena/softwaresena/PipelineToolbox.png',
        'https://previewweb.site/gambarsena/softwaresena/Pipesim.png',
        'https://previewweb.site/gambarsena/softwaresena/Primavera.png',
        'https://previewweb.site/gambarsena/softwaresena/PVElite.png',
      ],
      'equipmentImages' => [
        'https://previewweb.site/gambarsena/toolssena/CIPSdanDCVG.png',
        'https://previewweb.site/gambarsena/toolssena/CoatingPullOffAdhesionTester.png',
        'https://previewweb.site/gambarsena/toolssena/CoatingThicknessGauge.png',
        'https://previewweb.site/gambarsena/toolssena/Drone.png',
        'https://previewweb.site/gambarsena/toolssena/Echosounder.png',
        'https://previewweb.site/gambarsena/toolssena/ElectricYoke.png',
        'https://previewweb.site/gambarsena/toolssena/GasDetector.png',
        'https://previewweb.site/gambarsena/toolssena/GPSGeodeticGNSS.png',
        'https://previewweb.site/gambarsena/toolssena/GroundingTester.png',
        'https://previewweb.site/gambarsena/toolssena/HammerTest.png',
        'https://previewweb.site/gambarsena/toolssena/HighVoltageHolidayDetector.png',
        'https://previewweb.site/gambarsena/toolssena/HighVoltageInsulationTester.png',
        'https://previewweb.site/gambarsena/toolssena/LaserDistometer.png',
        'https://previewweb.site/gambarsena/toolssena/LowVoltageHolidayDetector.png'
      ]
    ]);
  }
  /**
   * Display all software and equipment page.
   */
  public function allSoftwareEquipment(): Response
  {
    return Inertia::render('Capability/AllSoftwareEquipment', [
      'items' => [
        // Software items
        [
          'id' => 1,
          'title' => 'ArcGIS',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Geographic Information System untuk pemetaan dan analisis spasial.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/ArcGIS.png',
          'type' => 'software'
        ],
        [
          'id' => 2,
          'title' => 'AutoCAD',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software Computer-Aided Design untuk drafting dan modeling 2D/3D.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/AutoCAD.png',
          'type' => 'software'
        ],
        [
          'id' => 3,
          'title' => 'Autopipe',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software untuk analisis stress dan design sistem perpipaan.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/Autopipe.png',
          'type' => 'software'
        ],
        [
          'id' => 4,
          'title' => 'CAESAR II',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software analisis stress pipa untuk industri petrokimia.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/CaesarII.png',
          'type' => 'software'
        ],
        [
          'id' => 5,
          'title' => 'ETAP',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Sistem analisis tenaga listrik untuk industri.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/ETAP.png',
          'type' => 'software'
        ],
        [
          'id' => 6,
          'title' => 'ASPEN HYSYS',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Simulator proses kimia untuk optimasi dan desain.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/HYSYS.png',
          'type' => 'software'
        ],
        [
          'id' => 7,
          'title' => 'Instrucalc',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software untuk perhitungan instrumentasi dan kontrol.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/Instrucalc.png',
          'type' => 'software'
        ],
        [
          'id' => 8,
          'title' => 'Microsoft Project',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software manajemen proyek untuk perencanaan dan monitoring.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/MicrosoftProject.png',
          'type' => 'software'
        ],
        [
          'id' => 9,
          'title' => 'OLGA',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software simulasi multiphase flow untuk pipeline.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/OLGA.png',
          'type' => 'software'
        ],
        [
          'id' => 10,
          'title' => 'PipeDataPro',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Database software untuk komponen dan material pipa.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/PipeDataPro.png',
          'type' => 'software'
        ],
        [
          'id' => 11,
          'title' => 'Pipeline Toolbox',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Perangkat lunak engineering untuk desain pipeline.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/PipelineToolbox.png',
          'type' => 'software'
        ],
        [
          'id' => 12,
          'title' => 'PIPESIM',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software simulasi aliran untuk sistem perpipaan.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/Pipesim.png',
          'type' => 'software'
        ],
        [
          'id' => 13,
          'title' => 'Primavera P6',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software enterprise project management untuk proyek besar.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/Primavera.png',
          'type' => 'software'
        ],
        [
          'id' => 14,
          'title' => 'PV Elite',
          'category' => 'Software',
          'year' => '2024',
          'description' => 'Software untuk desain dan analisis pressure vessel.',
          'image' => 'https://previewweb.site/gambarsena/softwaresena/PVElite.png',
          'type' => 'software'
        ],
        // Equipment items
        [
          'id' => 15,
          'title' => 'CIPS dan DCVG',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Close Interval Potential Survey dan DC Voltage Gradient untuk pipeline.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/CIPSdanDCVG.png',
          'type' => 'equipment'
        ],
        [
          'id' => 16,
          'title' => 'Coating Pull-Off Adhesion Tester',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat uji adhesi coating untuk kontrol kualitas lapisan.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/CoatingPullOffAdhesionTester.png',
          'type' => 'equipment'
        ],
        [
          'id' => 17,
          'title' => 'Coating Thickness Gauge',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat pengukur ketebalan coating untuk inspeksi material.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/CoatingThicknessGauge.png',
          'type' => 'equipment'
        ],
        [
          'id' => 18,
          'title' => 'Drone Survey',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Drone untuk survey udara dan inspeksi aerial.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/Drone.png',
          'type' => 'equipment'
        ],
        [
          'id' => 19,
          'title' => 'Echosounder',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat pengukur kedalaman air untuk survey bathymetry.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/Echosounder.png',
          'type' => 'equipment'
        ],
        [
          'id' => 20,
          'title' => 'Electric Yoke',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat magnetic particle testing untuk NDT inspection.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/ElectricYoke.png',
          'type' => 'equipment'
        ],
        [
          'id' => 21,
          'title' => 'Gas Detector',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat deteksi gas untuk keselamatan kerja dan monitoring.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/GasDetector.png',
          'type' => 'equipment'
        ],
        [
          'id' => 22,
          'title' => 'GPS Geodetic GNSS',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Sistem GPS geodetic untuk positioning dan survey presisi tinggi.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/GPSGeodeticGNSS.png',
          'type' => 'equipment'
        ],
        [
          'id' => 23,
          'title' => 'Grounding Tester',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat uji grounding untuk sistem kelistrikan dan safety.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/GroundingTester.png',
          'type' => 'equipment'
        ],
        [
          'id' => 24,
          'title' => 'Hammer Test',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Rebound hammer untuk uji kekuatan beton non-destruktif.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/HammerTest.png',
          'type' => 'equipment'
        ],
        [
          'id' => 25,
          'title' => 'High Voltage Holiday Detector',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat deteksi holiday coating tegangan tinggi.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/HighVoltageHolidayDetector.png',
          'type' => 'equipment'
        ],
        [
          'id' => 26,
          'title' => 'High Voltage Insulation Tester',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat uji isolasi tegangan tinggi untuk sistem elektrik.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/HighVoltageInsulationTester.png',
          'type' => 'equipment'
        ],
        [
          'id' => 27,
          'title' => 'Laser Distometer',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat pengukur jarak laser untuk survey dan measurement.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/LaserDistometer.png',
          'type' => 'equipment'
        ],
        [
          'id' => 28,
          'title' => 'Low Voltage Holiday Detector',
          'category' => 'Tools & Equipment',
          'year' => '2024',
          'description' => 'Alat deteksi holiday coating tegangan rendah.',
          'image' => 'https://previewweb.site/gambarsena/toolssena/LowVoltageHolidayDetector.png',
          'type' => 'equipment'
        ]
      ],
      'filters' => [
        'Software' => 'software',
        'Tools & Equipment' => 'equipment'
      ]
    ]);
  }
}
