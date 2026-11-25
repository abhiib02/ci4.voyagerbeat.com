<?php

namespace App\Libraries;

use App\Models\User;

class GoogleService
{
    public function sendDatatoGoogleSheet(array $data)
    {
        $UserModel = new User();
        $agentData = $UserModel->getUserByID($data['agent']);
        $pax = json_decode($data['pax_details'], true) ?? [];

        // 1st: sharing type without the word "Sharing"
        $sharing = implode(',', array_map(
            fn($s) => trim(preg_replace('/\s*sharing\s*/i', '', $s)),
            array_column($pax, 'sharing')
        ));                                                    // Quad,Triple

        // 2nd: boarding city
        $boarding_city = implode(',', array_column($pax, 'boarding_city'));   // asdsad,asdsad

        // 3rd: drop city
        $drop_city = implode(',', array_column($pax, 'drop_point'));

        // 4th: adhaar
        $adhaar = implode('|', array_column($pax, 'adhaar'));


        $data['sharing'] = $sharing;
        $data['date'] = explode("|", $data['date'])[0];
        $data['boarding_city'] = $boarding_city;
        $data['adhaar'] = $adhaar;
        $data['drop_city'] = $drop_city;
        $data['agent'] = $agentData->user_name;

        $url = 'https://script.google.com/macros/s/AKfycbzXTUEiyB8-R9ag3XYzo7h7bowyHM3KbhaYlIWcyq6Fh8aYD2uMt1swz4CDbaMM3lA_ZA/exec';


        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,   // required for Apps Script
            CURLOPT_TIMEOUT        => 30,
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            log_message('error', 'cURL error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $result;
    }
}
