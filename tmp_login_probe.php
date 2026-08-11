<?php

$cookieJar = __DIR__ . '/tmp_probe_cookie.txt';
$loginPageUrl = 'http://127.0.0.1:8000/login';
$loginPostUrl = 'http://127.0.0.1:8000/login';
$printUrl = 'http://127.0.0.1:8000/admin/laporan/persuratan/print?tanggal_awal=2026-08-01&tanggal_akhir=2026-08-09';

$ch = curl_init($loginPageUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200 || $html === false) {
    echo "LOGIN_PAGE_STATUS={$httpCode}\n";
    exit(1);
}

preg_match('/<input type="hidden" name="_token" value="([^"]+)"/i', $html, $m);
if (!isset($m[1])) {
    echo "NO_CSRF_TOKEN\n";
    exit(2);
}
$token = $m[1];

$loginData = http_build_query([
    '_token' => $token,
    'email' => 'admin@sipbongki.go.id',
    'password' => 'password',
    'remember' => 'on',
]);

$ch = curl_init($loginPostUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $loginData);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$resp = curl_exec($ch);
$loginCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$ch = curl_init($printUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$printBody = curl_exec($ch);
$printCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

if (strpos($printBody, 'LAPORAN DATA PERSURATAN') !== false || strpos($printBody, 'Rekapitulasi') !== false) {
    echo "RENDER_OK HTTP={$printCode} URL={$effectiveUrl}\n";
} else {
    echo "RENDER_FAIL HTTP={$printCode} URL={$effectiveUrl} BODY_LEN=" . strlen($printBody) . "\n";
    echo substr($printBody, 0, 250) . "\n";
}
