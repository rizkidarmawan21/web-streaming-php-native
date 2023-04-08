<?php

/**
 *  https://midtrans.com/id
 *  https://docs.midtrans.com/
 *  https://api-docs.midtrans.com/ 
 */

function midtrans($data)
{
    $auth_string = base64_encode('YOUR_PRIVATE_KEY');
    $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Accept: application/json\r\n" . "Content-Type: application/json\r\n" . "Authorization: Basic $auth_string:\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return json_decode($result);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
