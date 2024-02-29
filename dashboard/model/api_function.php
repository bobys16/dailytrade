<?php

function get_game($key) {
    $login = "https://undices.com/api/login/".$key;
    curl($login, null, $key,'true');
    $url = "https://undices.com/api/game";
    $json = json_decode(curl($url, null,$key));
    return $json;
}

function play($key, $data) {
    $url = "https://undices.com/api/dice";
    $json = curl($url, $data,$key);
    return $json;
}

function curl($url, $data=null, $cookie=null,$header=null) {
    $headers = array(
       "Accept: application/json, text/plain, */*",
       "Content-Type: application/json;charset=UTF-8",
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if($header!==null) {
        curl_setopt($ch, CURLOPT_HEADER, 1);
    }
    if($cookie !== null) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie.'.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie.'.txt');
    }
    if($data !== null) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}