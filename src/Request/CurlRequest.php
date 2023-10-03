<?php

namespace App\Request;

use App\Service\LogService;

class CurlRequest
{
    private object $response;

    public function __construct()
    {
        $this->response = new \stdClass();
        $this->response->code = 406;
        $this->response->status = false;
        $this->response->message = null;
        $this->response->data = [];
    }

    public function send(string $url, array $headers, string $requestBody): bool|string
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            LogService::log('curl', ['curl_error' => curl_error($curl)]);
            $this->response->status = false;
            $this->response->message = curl_error($curl);
            $this->response->code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            return "Code: {$this->response->code} | Message: {$this->response->message}";
        } else {
            $this->response->status = true;
            $this->response->code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $this->response->data = $response;
        }

        curl_close($curl);

        return $this->response->data;
    }
}
