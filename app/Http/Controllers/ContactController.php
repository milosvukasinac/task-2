<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\NewContactRequest;
use Mail;

class ContactController extends Controller
{
    public function sendMail(ContactRequest $request){

        // Send mail
        Mail::to('milosvukasinac@gmail.com')->send(new NewContactRequest($request));

        // If the email successfully sent, return back and success message
        return back()->with('success', 'Your message has been received!');
    }
}
