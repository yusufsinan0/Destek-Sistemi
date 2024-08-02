<?php

function sendApiRequestToken($endpoint, $method = '', $data = [], $token = null) {
    $url = 'https://yusufsinan.com' . $endpoint;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } else if ($method === 'GET') {
        curl_setopt($ch, CURLOPT_HTTPGET, true);
    }

    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];

    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return ['error' => $error];
    } else {
        $responseData = json_decode($response, true);
        curl_close($ch);
        return $responseData;
    }
}

function sendApiRequest($endpoint, $method = '', $data = []) {
    $url = 'https://yusufsinan.com' . $endpoint;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } else if ($method === 'GET') {
        curl_setopt($ch, CURLOPT_HTTPGET, true);
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return ['error' => $error];
    } else {
        // JSON yanıtı decode et
        $responseData = json_decode($response, true);
        curl_close($ch);
        return $responseData;
    }
}

function sendApiToken($endpoint, $token) {
    $url = 'https://yusufsinan.com' . $endpoint;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $token
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        return ['error' => $error];
    }

    $responseData = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $error = 'JSON Error: ' . json_last_error_msg();
        curl_close($ch);
        return ['error' => $error];
    }

    curl_close($ch);
    return $responseData;
}





?>
