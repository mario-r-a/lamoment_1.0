<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Storage;
use App\Mail\ContactFormMail;

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

        try {
            Mail::to('pius.marioruby@gmail.com')->send(new ContactFormMail($data));

            return redirect()->route('contact')
                ->with('success', 'Thank you for contacting us! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Contact form send failed', [
                'error' => $e->getMessage(),
                'payload' => $data,
            ]);
            
            // // Fallback: save to file for debug (use content_message for view)
            // try {
            //     $viewData = [
            //         'first_name' => $data['first_name'],
            //         'last_name' => $data['last_name'],
            //         'email' => $data['email'],
            //         'subject' => $data['subject'],
            //         'content_message' => $data['message'], // RENAMED for view
            //     ];
            //     $html = view('emails.contact-inline', $viewData)->render();
            //     Storage::put('logs/contact-failed-'.time().'.html', $html);
            // } catch (\Throwable $ex) {
            //     Log::warning('Failed to render/save contact email debug file', ['error' => $ex->getMessage()]);
            // }

            return redirect()->route('contact')
                ->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly via email/phone.');
        }
    }
}