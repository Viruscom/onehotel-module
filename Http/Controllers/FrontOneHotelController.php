<?php

namespace Modules\OneHotel\Http\Controllers;

use App\Models\Settings\Application;
use App\Models\Settings\Post;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\OneHotel\Emails\InquiryEmail;
use Modules\OneHotel\Http\Requests\InquiryFormRequest;

class FrontOneHotelController extends Controller
{
    public function sendInquiry($languageSlug, InquiryFormRequest $request)
    {
        $request->validate([
            'turnstile' => 'required',
        ]);

        $secret = Application::getSettings()->google_recaptcha_ver3_secret;
        $response = $request->input('turnstile');

        $result = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $request->ip(),
        ]);

        $verify = $result->json();


        if (isset($verify['success']) && $verify['success']) {
            try {
                $mail       = new InquiryEmail($request);
                $adminEmail = Post::getSettings()->mailing_email_from;

                Mail::to(trim($adminEmail))->send($mail);

                if ($request->has('copy_to_me')) {
                    Mail::to($request->input('email'))->send($mail);
                }

                return redirect()->back()->with('success-message', 'Your inquiry has been sent successfully!');
            } catch (Exception $exception) {
                Log::error('Error sending email: ' . $exception->getMessage());

                return redirect()->back()->withErrors(['front.contacts.message_sent_failed']);
            }
        } else {
            return redirect()->back()->withErrors(['front.contacts.message_sent_failed']);
        }
    }
}
