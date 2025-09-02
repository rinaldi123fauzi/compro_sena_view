<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
  /**
   * Display the contact page.
   */
  public function index(): Response
  {
    return Inertia::render('Contact', [
      'offices' => [
        [
          'name' => 'Head Office Jakarta',
          'address' => 'Kompleks Perkantuan Dan Pergudangan, Jalan Margonda Raya, Kota Depok, Jawa Barat 16424',
          'phone' => '(021) 2210-4908',
          'email' => 'info@ptsena.com',
          'coordinates' => [-6.366667, 106.816667],
          'working_hours' => [
            'weekdays' => 'Senin - Jumat: 08:00 - 17:00',
            'saturday' => 'Sabtu: 08:00 - 12:00',
            'sunday' => 'Minggu: Tutup'
          ]
        ]
      ],
      'social_media' => [
        'linkedin' => 'https://linkedin.com/company/ptsena',
        'instagram' => 'https://instagram.com/ptsena',
        'youtube' => 'https://youtube.com/ptsena',
        'facebook' => 'https://facebook.com/ptsena'
      ],
      'company_info' => [
        'tagline' => 'Your Trusted Partner in Engineering Excellence',
        'description' => 'PT Solusi Energy Nusantara (SENA) adalah perusahaan engineering terpercaya yang menyediakan solusi inovatif untuk berbagai kebutuhan industri.',
        'specialties' => [
          'Konsultasi Engineering',
          'Desain & Perencanaan',
          'Project Management',
          'Quality Assurance',
          'Maintenance Services'
        ]
      ]
    ]);
  }
  /**
   * Handle contact form submission.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'phone' => 'nullable|string|max:20',
      'subject' => 'required|string|max:255',
      'message' => 'required|string|max:2000',
      'company' => 'nullable|string|max:255'
    ], [
      'name.required' => 'Nama lengkap wajib diisi.',
      'name.max' => 'Nama lengkap maksimal 255 karakter.',
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.max' => 'Email maksimal 255 karakter.',
      'phone.max' => 'Nomor telepon maksimal 20 karakter.',
      'subject.required' => 'Subjek wajib diisi.',
      'subject.max' => 'Subjek maksimal 255 karakter.',
      'message.required' => 'Pesan wajib diisi.',
      'message.max' => 'Pesan maksimal 2000 karakter.',
      'company.max' => 'Nama perusahaan maksimal 255 karakter.'
    ]);

    try {
      // Here you would typically save to database or send email
      // Example: Store in database
      /*
      \App\Models\ContactMessage::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'company' => $validated['company'],
        'subject' => $validated['subject'],
        'message' => $validated['message'],
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
      ]);
      */

      // Example: Send email notification
      /*
      \Mail::to('admin@ptsena.com')->send(new \App\Mail\ContactFormSubmitted($validated));
      */

      return back()->with('success', 'Terima kasih atas pesan Anda. Tim kami akan segera menghubungi Anda!');
    } catch (\Exception $e) {
      \Log::error('Contact form submission failed: ' . $e->getMessage());
      return back()->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi kami melalui telepon.');
    }
  }
}
