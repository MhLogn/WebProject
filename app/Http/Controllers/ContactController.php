<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactData = $request->only(['name', 'email', 'subject', 'message']);

        Mail::to('daylaaccclone39@gmail.com')->send(new ContactMail($contactData));

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi, chúng tôi sẽ phản hồi lại bạn sớm!');
    }
}
