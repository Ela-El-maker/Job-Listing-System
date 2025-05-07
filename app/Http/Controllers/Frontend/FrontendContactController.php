<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactFormRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class FrontendContactController extends Controller
{
    //
    public function index(): View
    {
        return view('frontend.pages.contact');
    }

    // function sendMail(ContactFormRequest $request)
    // {
    //     // dd($request->all());
    //     Mail::to(config('settings.site_email'))->send(
    //         new ContactMail($request->name, $request->email, $request->phone, $request->company, $request->subject, $request->message)
    //     );
    // }

    public function sendMail(ContactFormRequest $request)
    {
        try {
            Mail::to(config('settings.site_email'))->send(
                new ContactMail(
                    $request->name,
                    $request->email,
                    $request->phone,
                    $request->company,
                    $request->subject,
                    $request->message
                )
            );

            return response()->json([
                'success' => true,
                'redirect' => route('contact.index'), // or any other route
                'message' => 'Message sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ], 500);
        }
    }
}
