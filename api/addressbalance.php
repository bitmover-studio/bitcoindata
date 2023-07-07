<?php
require "functions.php";

header('Cache-Control: max-age=45');
$currency = "usd";
$rates = 1;

if (isset($_GET["address"]))
    $address = $_GET["address"];
if (isset($_GET["currency"]))
    $currency = strtolower($_GET["currency"]);

$btcpriceusd = getBTCPriceUsd('bitcoin');

$currency = strtoupper($currency);
if ($currency != 'USD' && $currency != 'BDT') {
    $exchangerate = "https://api.exchangerate.host/latest?base=USD";
    $exchangeratejson = getData($exchangerate);
    $rates = $exchangeratejson->rates->$currency;
}

else if ($currency == 'BDT') {
    $url = 'https://p2p.binance.com/bapi/c2c/v2/public/c2c/adv/quoted-price';
    $postFields = array(
        'assets' => array('USDT'),
        'fiatCurrency' => 'BDT',
        'tradeType' => 'BUY',
        'fromUserRole' => 'USER'
    );
    $postData = json_encode($postFields);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Content-Length: " . strlen($postData) . "\r\n",
            'method'  => 'POST',
            'content' => $postData
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $exratejsonArray = json_decode($result);
    $rates = $exratejsonArray->data[0]->referencePrice;
}

$price = $btcpriceusd * $rates;

$dataUrl = "https://mempool.space/api/address/" . $address;
$explorerjsonArray = getData($dataUrl);

$addressbalance = ($explorerjsonArray->chain_stats->funded_txo_sum - $explorerjsonArray->chain_stats->spent_txo_sum) / 100000000;
$addressvalue = number_format($addressbalance * $price, 2);

$string = $address . " " . $addressbalance . " BTC - " . $addressvalue . " " . $currency;


header('Content-type: image/gif'); // filetype

$font = 4;
$width = (imagefontwidth($font) * strlen($string)) + 3;
$height = (imagefontheight($font));

$image = imagecreatetruecolor($width, $height);
$black = imagecolorallocate($image, 112, 112, 112);
$white = imagecolorallocate($image, 255, 255, 255);
imagecolortransparent($image, $white);

imagefill($image, 0, 0, $white);

imagestring($image, $font, 0, 0, $string, $black);


header('Content-type: image/gif');

imagegif($image, 'addressbalance.gif');

readfile('addressbalance.gif');
imagedestroy($image); // free up memory
exit;