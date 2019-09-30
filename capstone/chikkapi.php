<?php
    $arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => "639272000356",
        "shortcode" => "29290 745745",
        "message_id" => "12345678901234567890123456789012",
        "message" => urlencode("Welcome to My Service!"),
        "client_id" => "f04ac114bc8654d73e111d24947b3ad6cb9654d85de0153f16be0d2c2e8c7712",
        "secret_key" => "56e5e2c131d8f76240b76c6831579fbf3beef92b2f9bb1c6ad4a3b4425b262a5"
    );

    $query_string = "";
    foreach($arr_post_body as $key => $frow)
    {
        $query_string .= '&'.$key.'='.$frow;
    }

    $URL = "https://post.chikka.com/smsapi/request";

    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);

    exit(0);



?>