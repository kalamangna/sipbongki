<?php
$cookieFile = __DIR__ . '/tmp_login_cookie.txt';
$loginPageUrl = 'http://127.0.0.1:8000/login';
$loginPostUrl = 'http://127.0.0.1:8000/login';

$ch = curl_init($loginPageUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "GET_LOGIN_HTTP={$httpCode}\n";

preg_match('/<input type="hidden" name="_token" value="([^"]+)"/i', $html, $matches);
if (!isset($matches[1])) {
    echo "NO_CSRF_TOKEN\n";
    exit(1);
}
$token = $matches[1];
echo "TOKEN={$token}\n";

$postData = [
    '_token' => $token,
    'email' => 'admin@sipbongki.go.id',
    'password' => 'password',
    'remember' => 'on',
];

$ch = curl_init($loginPostUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
$loginRaw = curl_exec($ch);
$loginCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "POST_LOGIN_HTTP={$loginCode}\n";
echo $loginRaw;
