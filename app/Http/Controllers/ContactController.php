<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormNotification;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\Profile;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        PageView::create(['page' => '/contact', 'ip_address' => request()->ip()]);
        $profile     = Profile::first();
        $socialLinks = SocialLink::where('is_visible', true)->orderBy('sort_order')->get();
        return view('contact', compact('profile', 'socialLinks'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:191',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'ip_address' => $request->ip(),
        ]);

        $toEmail = Profile::first()?->email ?? config('mail.from.address');
        if ($toEmail) {
            try {
                Mail::to($toEmail)->send(new ContactFormNotification(
                    senderName: $request->name,
                    senderEmail: $request->email,
                    contactSubject: $request->subject,
                    message: $request->message
                ));
            } catch (\Throwable $e) {
                \Log::warning('Contact form email failed: ' . $e->getMessage());
            }
        }

        return back()->with('sent', 'Your message has been sent! I\'ll get back to you soon.');
    }
}
