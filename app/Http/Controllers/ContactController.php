<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // formulaire de contact
    public function contact()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $details = $request->validate([
          'name' => 'required|min:6',
          'email' => 'required|min:6',
          'subject' => 'required|min:6',
          'message' => 'required|min:6',
        ]);

        $success = 'Votre message a bien été envoyé.';

        Mail::to('hello@eosia.dev')->send(new ContactMail($details));

        return redirect()->route('contact')->withSuccess($success);

    }


}
