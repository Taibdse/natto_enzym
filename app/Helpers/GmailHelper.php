<?php

namespace App\Helpers;

use Dacastro4\LaravelGmail\Services\Message\Mail;
use Illuminate\Log;
use Illuminate\Support\Facades\Mail as LaravelMail;
use App\Mail\SendMail;

class GmailHelper
{
    const SENDER_EMAIL = 'codebase@admicro.vn';
    const SENDER_NAME = 'Codebase System';
    const MAILTRAP = false;

    //Mailtrap.io: username: codebase.robot@gmail.com
    //             password: Codebase123**

    // Send email
    public static function sendEmail($sendTo, $subject, $body){

        $mail = new Mail;
        $mail->to( $sendTo, null );
        $mail->from( GmailHelper::SENDER_EMAIL, GmailHelper::SENDER_NAME);
        $mail->subject($subject);
        $mail->message($body);

        try{

            if (GmailHelper::MAILTRAP) {
                if (config('app.env') === 'local') {
                    LaravelMail::to($sendTo)->send(new SendMail($subject, $body));
                    return true;
                }
            }

            return $mail->send();

        }catch (\Exception $ex){
            Log:info($ex->getMessage());
            return false;
        }
    }
}
