<?php

function request(string $url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/" . $url);

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

    $headers = getHeaders(substr($response, 0, $header_size));
    $statusCode =  curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $body = substr($response, $header_size);

    curl_close($ch);
    return [
        "headers" => $headers,
        'statusCode' => $statusCode,
        "body" => $body
    ];
}

function getHeaders($input)
{
    $data = explode("\n", $input);
    $headers['status'] = $data[0];
    array_shift($data);

    foreach ($data as $part) {
        $middle = explode(":", $part, 2);
        if (!isset($middle[1])) {
            $middle[1] = null;
        }

        $headers[trim($middle[0])] = trim($middle[1]);
    }
    return $headers;
}

function getJsonPath(string $json)
{
    return realpath(__DIR__ . DIRECTORY_SEPARATOR . 'jsonFiles' . DIRECTORY_SEPARATOR . $json);
}
