<?php
$cookieFile = __DIR__ . '/tmp_auth_cookie.txt';
$loginPageUrl = 'http://127.0.0.1:8000/login';
$loginPostUrl = 'http://127.0.0.1:8000/login';
$printUrl = 'http://127.0.0.1:8000/admin/laporan/persuratan/print?tanggal_awal=2026-08-01&tanggal_akhir=2026-08-09';

$cp = curl_init($loginPageUrl);
curl_setopt($cp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cp, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($cp, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($cp, CURLOPT_FOLLOWLOCATION, false);
$html = curl_exec($cp);
curl_close($cp);

preg_match('/<input type="hidden" name="_token" value="([^"]+)"/i', $html, $m);
if (!isset($m[1])) {
    echo "LOGIN_PAGE_NO_CSRF\n";
    exit(1);
}
$token = $m[1];

$postData = http_build_query([
    '_token' => $token,
    'email' => 'admin@sipbongki.go.id',
    'password' => 'password',
    'remember' => 'on'
]);

$ch = curl_init($loginPostUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$loginResp = curl_exec($ch);
curl_close($ch);

$printCh = curl_init($printUrl);
curl_setopt($printCh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($printCh, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($printCh, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($printCh, CURLOPT_FOLLOWLOCATION, true);
$printBody = curl_exec($printCh);
$printHttpCode = curl_getinfo($printCh, CURLINFO_HTTP_CODE);
$effectiveUrl = curl_getinfo($printCh, CURLINFO_EFFECTIVE_URL);
curl_close($printCh);

$bodySnippet = substr(strip_tags($printBody), 0, 300);
if (strpos($printBody, 'LAPORAN DATA PERSURATAN') !== false || strpos($printBody, 'Rekapitulasi') !== false || strpos($printBody, 'Nomor Permohonan') !== false) {
    echo "PRINT_RENDER_OK HTTP={$printHttpCode} EFFECTIVE={$effectiveUrl}\n";
    echo "BODY_HAS_REPORT_MARKER\n";
} else {
    echo "PRINT_RENDER_FAIL HTTP={$printHttpCode} EFFECTIVE={$effectiveUrl}\n";
    echo "BODY_SNIPPET={$bodySnippet}\n";
}
