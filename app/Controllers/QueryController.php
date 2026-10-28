<?php

namespace App\Controllers;

use Config\Services;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class QueryController extends BaseController
{
    public function submitQuery()
    {
        // 1. Retrieve incoming data
        $postData = $this->request->getPost() ?: $this->request->getJSON(true);

        // 2. Honeypot check
        if (!empty($postData['human'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Spam detected.',
            ]);
        }

        // Clean internal honeypot field before sending outward
        unset($postData['human']);

        $results = [];

        // ----------------------------------------------------
        // REQUEST 1: CRM (application/x-www-form-urlencoded)
        // ----------------------------------------------------
        $crmUrl = 'https://crm.voyagersbeat.com/landingpageenquiry.mytrav';
        $crmPayload = http_build_query($postData);

        $ch1 = curl_init();
        curl_setopt_array($ch1, [
            CURLOPT_URL            => $crmUrl,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $crmPayload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($crmPayload),
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ],
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $crmResponse = curl_exec($ch1);
        $crmHttpCode = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        $crmError    = curl_error($ch1);
        curl_close($ch1);

        if ($crmResponse === false || !empty($crmError)) {
            log_message('error', '[CRM cURL Error] ' . $crmError);
        } else {
            log_message('info', '[CRM Response Code ' . $crmHttpCode . '] ' . $crmResponse);
        }

        // ----------------------------------------------------
        // REQUEST 2: Google Apps Script (application/json)
        // ----------------------------------------------------
        $scriptUrl = 'https://script.google.com/macros/s/AKfycbwaBkx0rx5vYwIJ6AFy6ibQlRasLyh7kU9Qd4xiJ0Kym4ry31vKkWRO2xxg9YVCk4UYTA/exec';
        $jsonPayload = json_encode($postData);

        $ch2 = curl_init();
        curl_setopt_array($ch2, [
            CURLOPT_URL            => $scriptUrl,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $jsonPayload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTREDIR      => CURL_REDIR_POST_ALL, // Required for Google redirects
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        ]);

        $scriptResponse = curl_exec($ch2);
        $scriptHttpCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        $scriptError    = curl_error($ch2);
        curl_close($ch2);

        if ($scriptResponse === false || !empty($scriptError)) {
            log_message('error', '[Google Script cURL Error] ' . $scriptError);
        }

        // 3. Set Flashdata and Redirect
        $this->session->setFlashdata('FlashMessage', [
            'message' => 'Query Submitted Successfully',
            'status'  => 'success',
        ]);

        return redirect()->back();
    }
}
