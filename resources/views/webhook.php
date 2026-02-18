<?php

$secret = env('WEBHOOK_SECRET');

$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

$hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($hash, $signature)) {
    http_response_code(403);
    exit('Invalid signature');
}

// pull repo
shell_exec('cd /pemkab.satuproject.web.id/sertifikasi-pemkab-badung/ && git pull origin main 2>&1');

echo "Deploy success";
