<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Model\user\Contact;


class ContactController extends Controller
{
    // Store Contact Form data
    public function ContactForm(Request $request)
    {
        try {
            $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $request->get("g-recaptcha-response")
            ]);
            if ($response['success'] == false) {
                return response()->json(['error' => "veuillez vérifier le recaptcha"], 401);
            }
            // Form validation
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            //  Store data in database
            Contact::create($request->all());

            //  Send mail to Application Admin
            Mail::send('emails.contactemail', array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'bodyMessage' => $request->get('message'),
            ), function ($message) use ($request) {
                $message->to('jihedhamdi52@gmail.com', 'Admin')->subject($request->get('subject'));
                $message->to(env('MAIL_FROM_ADDRESS', 'contact@frequencem.com'), 'Admin')->subject($request->get('subject'));
            });
            return response()->json(['success' => 'The email has been sent.']);
        } catch (\Exception $error) {
            //return $error->getMessage();
            return response()->json(['error' => 'Erreur votre email n\'est pas envoyer.'], 401);
        }
    }
}
