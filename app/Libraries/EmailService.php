<?php

namespace App\Libraries;

class EmailService
{
    public function sendPointsEmail(array $data)
    {

        $email = \Config\Services::email();
        switch ($data["type"]) {
            case 'gift':
                $email->setSubject('Diwali Gift Points Added to Your Account');
                $messageHtml = view('emails/diwali_gift_points_email', ['data' => $data]);
                break;
            default:
                $email->setSubject('Loyalty Points Added to Your Account');
                $messageHtml = view('emails/loyalty_points_email', ['data' => $data]);
                break;
        }

        $email->setFrom(env('contact_form_sender_email'), env('app.name'));
        $email->setTo($data['user_email']);
        $email->setMessage($messageHtml);

        return $email->send();
    }
}
