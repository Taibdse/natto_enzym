<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/23/2016
 * Time: 8:45 AM
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Mail;

class NotificationHelper
{
    public static function sendTelegram($message){
        $apiToken = "456942362:AAGAdB7qNx1wtMzoZruMIFJHg1oXgFylN5k";
        $data = [
            'chat_id' => '-349921072',
            'text' => $message
        ];

        try {
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) . '&parse_mode=html' );
            return true;
        }
        catch (\Exception $e) {
            Log::info($e->getMessage());
            return false;
        }
    }

    public static function sendEmail($subject, $template, $data, $toEmail, $toName, $ccAdmin=true){
        try {
            Mail::send($template, $data, function ($m) use ($subject, $template, $data, $toEmail, $toName, $ccAdmin) {
                $m->subject($subject);

                $m->from(env('MAIL_FROM', 'noreply@vinatours.net'), env('MAIL_FROM_NAME', 'VinaTours.net'));
                $m->to($toEmail, $toName);
                $m->replyTo(env('MAIL_ADMIN', 'info@vinatours.net'), env('MAIL_ADMIN_NAME', 'VinaTours.net'));

                if($ccAdmin) {
                    $m->cc(env('MAIL_ADMIN', 'info@vinatours.net'), env('MAIL_ADMIN_NAME', 'VinaTours.net'));
                }
            });
        }
        catch (\Exception $e) {
            Log::info($e->getMessage());
            return false;
        }
    }
}