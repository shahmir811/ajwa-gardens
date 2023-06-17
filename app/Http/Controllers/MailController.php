<?php

namespace App\Http\Controllers;

use Mail;
use Config;
use App\Mail\TestEmail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function checkMail()
    {
        // dd("HELLO");
        $emailTo = Config::get('customvariables.zaffar_bhai_email');
        Mail::to($emailTo)->send(new TestEmail);

        return view('email');
    }
}
