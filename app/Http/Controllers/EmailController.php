<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Email;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //

    public function processUnsentEmails()
    {

        // Grab all emails which have current not been sent
        $emails = Email::where('is_sent', '=', null)->orWhere('is_sent', '=', '0')->get();

        foreach ($emails as $email) {

            // Send new Email out
            Mail::to('contact@albertacraneservice.com')->send(new ContactForm($email['email'], $email['fullName'], $email['phone'], $email['message']));

            //update database setting value to 1
            DB::table('emails')->where('id', '=', $email['id'])
                ->update(['is_sent' => true]);
            echo 'updated '.$email['email'];
        }
    }
}
