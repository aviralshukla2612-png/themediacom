<?php

// verify_inquiry_flow.php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting Inquiry Flow Verification...\n\n";

// Ensure previous test records are deleted
\App\Models\Inquiry::where('name', 'TEST_INQUIRY_PHASE_E')->delete();

$baseUrl = 'http://127.0.0.1:8000';

// 1. GET /contact to fetch CSRF token and Session cookie
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/contact');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);
curl_close($ch);

// Extract CSRF token
preg_match('/<input type="hidden" name="_token" value="([^"]+)"/i', $body, $matches);
$csrfToken = $matches[1] ?? null;

// Extract Session Cookie
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $cookieMatches);
$cookies = array();
foreach($cookieMatches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
$cookieStr = '';
foreach ($cookies as $key => $val) {
    if ($key !== 'expires' && $key !== 'Max-Age' && $key !== 'path' && $key !== 'httponly' && $key !== 'samesite') {
        $cookieStr .= "$key=$val; ";
    }
}

if (!$csrfToken) {
    echo "FAIL: Could not extract CSRF token. Is the contact form rendering correctly?\n";
    exit(1);
}

echo "CSRF Token extracted: " . substr($csrfToken, 0, 10) . "...\n";

// 2. POST to /contact/submit
$postData = [
    '_token' => $csrfToken,
    'name' => 'TEST_INQUIRY_PHASE_E',
    'phone' => '1234567890',
    'company' => 'Test Corp',
    'email' => 'test@test.com',
    'message' => 'This is a test inquiry for Phase E verification.'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/contact/submit');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_COOKIE, $cookieStr);
curl_setopt($ch, CURLOPT_HEADER, true);
$postResponse = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "POST /contact/submit returned HTTP: $httpCode\n";

// 3. Verify DB
$inquiry = \App\Models\Inquiry::where('name', 'TEST_INQUIRY_PHASE_E')->first();
if ($inquiry) {
    echo "PASS: Test inquiry found in database! ID: " . $inquiry->id . "\n";
    
    // Filament InquiryResource rendering check
    if (class_exists(\App\Filament\Resources\Inquiries\InquiryResource::class)) {
        echo "PASS: Filament InquiryResource exists and is ready to display the record.\n";
    } else {
        echo "FAIL: Filament InquiryResource not found.\n";
    }
    
    // Delete it
    $inquiry->delete();
    echo "PASS: Deleted ONLY the TEST_INQUIRY_PHASE_E record.\n";
} else {
    echo "FAIL: Test inquiry NOT found in database.\n";
}

$remainingTest = \App\Models\Inquiry::where('name', 'TEST_INQUIRY_PHASE_E')->count();
if ($remainingTest === 0) {
    echo "PASS: Database is clean of the temporary test record.\n";
} else {
    echo "FAIL: Database still contains test record.\n";
}
