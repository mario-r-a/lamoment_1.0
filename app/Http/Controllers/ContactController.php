<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string|max:2000',
        ]);

        // Send email (configure mail settings in .env)
        try {
            Mail::send('emails.contact', $data, function($message) use ($data) {
                $message->to('lamoment.idn@gmail.com')
                        ->subject('Contact Form: ' . $data['subject'])
                        ->replyTo($data['email'], $data['first_name'] . ' ' . $data['last_name']);
            });

            return redirect()->route('contact')
                ->with('success', 'Thank you for contacting us! We will get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->route('contact')
                ->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly via email/phone.');
        }
    }
}