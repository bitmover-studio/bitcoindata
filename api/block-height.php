<?php
header('Content-Type: text/plain');
header('Access-Control-Allow-Origin: *');

if (!isset($_GET['block']) || !is_numeric($_GET['block'])) {
    http_response_code(400);
    echo "Invalid block height";
    exit;
}

$blockHeight = $_GET['block'];
$url = "https://mempool.space/api/block-height/" . urlencode($blockHeight);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; BitcoinDataProxy/1.0)');
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    http_response_code(500);
    echo "Proxy error: " . curl_error($ch);
} else {
    http_response_code($httpCode);
    echo $response;
}

curl_close($ch);
?>
