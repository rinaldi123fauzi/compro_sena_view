<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
  /**
   * Display all services.
   */
  public function index(): Response
  {
    return Inertia::render('Services', [
      'services' => [
        [
          'id' => 1,
          'title' => 'Civil Engineering',
          'description' => 'Comprehensive civil engineering solutions for infrastructure development.',
          'icon' => 'building',
          'features' => [
            'Structural Design',
            'Road Construction',
            'Bridge Engineering',
            'Geotechnical Analysis'
          ]
        ],
        [
          'id' => 2,
          'title' => 'Mechanical Engineering',
          'description' => 'Advanced mechanical systems design and implementation.',
          'icon' => 'cog',
          'features' => [
            'HVAC Systems',
            'Industrial Equipment',
            'Automation Solutions',
            'Maintenance Services'
          ]
        ],
        [
          'id' => 3,
          'title' => 'Electrical Engineering',
          'description' => 'Complete electrical systems and power solutions.',
          'icon' => 'bolt',
          'features' => [
            'Power Distribution',
            'Control Systems',
            'Renewable Energy',
            'Smart Building Technology'
          ]
        ]
      ]
    ]);
  }

  /**
   * Display specific service details.
   */
  public function show($id): Response
  {
    // In a real application, you would fetch from database
    $services = [
      1 => [
        'title' => 'Civil Engineering',
        'description' => 'Our civil engineering team provides comprehensive solutions for all your infrastructure needs.',
        'long_description' => 'With over 25 years of experience, our civil engineering division has successfully completed numerous projects ranging from residential buildings to major infrastructure developments.',
        'capabilities' => [
          'Structural Analysis and Design',
          'Foundation Engineering',
          'Transportation Infrastructure',
          'Water Resources Engineering',
          'Environmental Engineering'
        ],
        'projects' => [
          'Jakarta-Bandung High Speed Rail',
          'Suramadu Bridge Maintenance',
          'Jakarta MRT Infrastructure'
        ]
      ]
    ];

    $service = $services[$id] ?? abort(404);

    return Inertia::render('Services/Show', [
      'service' => $service
    ]);
  }
}
