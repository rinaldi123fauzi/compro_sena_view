<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CareerController extends Controller
{
  /**
   * Display career opportunities.
   */
  public function index()
  {
    return Inertia::render('Career/Index', [
      'openings' => [
        [
          'id' => 1,
          'title' => 'Senior Civil Engineer',
          'department' => 'Engineering',
          'location' => 'Jakarta',
          'type' => 'Full-time',
          'experience' => '5+ years',
          'posted_date' => '2024-05-15',
          'description' => 'Looking for experienced civil engineer to lead infrastructure projects.'
        ],
        [
          'id' => 2,
          'title' => 'Project Manager',
          'department' => 'Project Management',
          'location' => 'Surabaya',
          'type' => 'Full-time',
          'experience' => '7+ years',
          'posted_date' => '2024-05-10',
          'description' => 'Manage complex engineering projects from conception to completion.'
        ],
        [
          'id' => 3,
          'title' => 'Junior Mechanical Engineer',
          'department' => 'Engineering',
          'location' => 'Jakarta',
          'type' => 'Full-time',
          'experience' => '1-3 years',
          'posted_date' => '2024-05-20',
          'description' => 'Join our mechanical engineering team for HVAC and industrial projects.'
        ]
      ],
      'benefits' => [
        'Competitive salary package',
        'Health insurance for family',
        'Professional development programs',
        'Performance bonuses',
        'Flexible working hours',
        'Modern office facilities'
      ]
    ]);
  }

  /**
   * Display specific job opening.
   */
  public function show($id)
  {
    // In real application, fetch from database
    $jobs = [
      1 => [
        'title' => 'Senior Civil Engineer',
        'department' => 'Engineering',
        'location' => 'Jakarta',
        'type' => 'Full-time',
        'experience' => '5+ years',
        'salary_range' => 'Rp 15,000,000 - Rp 25,000,000',
        'description' => 'We are looking for an experienced Senior Civil Engineer to join our team and lead complex infrastructure projects.',
        'responsibilities' => [
          'Lead design and analysis of civil engineering projects',
          'Coordinate with multidisciplinary teams',
          'Ensure compliance with safety and quality standards',
          'Mentor junior engineers',
          'Review technical drawings and specifications'
        ],
        'requirements' => [
          'Bachelor\'s degree in Civil Engineering',
          'Minimum 5 years of relevant experience',
          'Professional Engineer (PE) license preferred',
          'Experience with AutoCAD, SAP2000, and other engineering software',
          'Strong communication and leadership skills'
        ],
        'benefits' => [
          'Competitive salary',
          'Health insurance',
          'Professional development',
          'Performance bonus'
        ]
      ]
    ];

    $job = $jobs[$id] ?? abort(404);

    return Inertia::render('Career/Show', [
      'job' => $job
    ]);
  }

  /**
   * Display internship opportunities.
   */
  public function internships()
  {
    return Inertia::render('Career/Internships', [
      'programs' => [
        [
          'title' => 'Engineering Internship Program',
          'duration' => '3-6 months',
          'departments' => ['Civil Engineering', 'Mechanical Engineering', 'Electrical Engineering'],
          'description' => 'Hands-on experience in real engineering projects with mentorship from senior engineers.'
        ],
        [
          'title' => 'Project Management Trainee',
          'duration' => '6 months',
          'departments' => ['Project Management'],
          'description' => 'Learn project management methodologies while supporting active projects.'
        ]
      ]
    ]);
  }

  /**
   * Display benefits information.
   */
  public function benefits()
  {
    return Inertia::render('Career/Benefits', [
      'benefits' => [
        'compensation' => [
          'title' => 'Competitive Compensation',
          'items' => [
            'Market-competitive salaries',
            'Performance-based bonuses',
            'Annual salary reviews',
            'Stock option programs'
          ]
        ],
        'health' => [
          'title' => 'Health & Wellness',
          'items' => [
            'Comprehensive health insurance',
            'Dental and vision coverage',
            'Annual health checkups',
            'Fitness center membership'
          ]
        ],
        'development' => [
          'title' => 'Professional Development',
          'items' => [
            'Training and certification programs',
            'Conference attendance support',
            'Tuition reimbursement',
            'Career advancement opportunities'
          ]
        ],
        'lifestyle' => [
          'title' => 'Work-Life Balance',
          'items' => [
            'Flexible working hours',
            'Remote work options',
            'Paid time off',
            'Family-friendly policies'
          ]
        ]
      ]
    ]);
  }
}
