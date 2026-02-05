<?php

// 1. Configuration
$myDomain = 'bitcoindata.science'; 

// The web-accessible path to this specific PHP file. 
// Do not include query parameters (?) here.
$scriptPath = '/api/s_analytics.php'; 

// 2. Determine the "route" using PATH_INFO
// If you access .../s_analytics.php/events, this will be '/events'
$route = $_SERVER['PATH_INFO'] ?? '/proxy.js';

// 3. Define Upstream Endpoints
$endpoints = [
    'proxy.js'       => 'https://simpleanalyticsexternal.com/proxy.js',
    'auto-events.js' => 'https://scripts.simpleanalyticscdn.com/auto-events.js',
    '/events'        => 'https://queue.simpleanalyticscdn.com/events',
    '/simple.gif'    => 'https://queue.simpleanalyticscdn.com/simple.gif'
];

// 4. Handle The Main Script (proxy.js)
if ($route === '/proxy.js' || $route === '/latest.js') {
    header('Content-Type: application/javascript');
    header('Cache-Control: public, max-age=21600'); 
    
    // We construct the upstream URL manually to avoid encoding issues
    // We tell SimpleAnalytics: "Treat my PHP file as the folder"
    $upstreamUrl = $endpoints['proxy.js'] . 
                   '?hostname=' . $myDomain . 
                   '&path=' . $scriptPath; 
    
    echo file_get_contents($upstreamUrl);
    exit;
}

// 5. Handle Auto Events Script
if ($route === '/auto-events.js') {
    header('Content-Type: application/javascript');
    header('Cache-Control: public, max-age=21600'); 
    echo file_get_contents($endpoints['auto-events.js']);
    exit;
}

// 6. Handle API POST (/events)
if ($route === '/events') {
    $payload = file_get_contents('php://input');
    
    $headers = [
        'Content-Type: application/json',
        'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
        'X-Forwarded-For: ' . getUserIP(), 
        'Referer: ' . ($_SERVER['HTTP_REFERER'] ?? ''),
        'DNT: ' . ($_SERVER['HTTP_DNT'] ?? '0')
    ];

    $ch = curl_init($endpoints['/events']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    http_response_code($httpCode);
    echo $response;
    exit;
}

// 7. Handle Pixel Fallback (/simple.gif)
if ($route === '/simple.gif') {
    header('Content-Type: image/gif');
    header('Cache-Control: no-cache, no-store, must-revalidate');

    // Forward the parameters (uid, url, etc.)
    $queryString = $_SERVER['QUERY_STRING'] ?? '';
    
    $pixelUrl = $endpoints['/simple.gif'] . '?' . $queryString;
    
    echo file_get_contents($pixelUrl);
    exit;
}

function getUserIP() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    return $_SERVER['REMOTE_ADDR'];
}
?>