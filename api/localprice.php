<?php
require "functions.php";

header('Cache-Control: max-age=45');
$coin = "bitcoin";
$currency = "usd";
$amount = 1;
$rates = 1;
$hex = "000";

if (isset($_GET["currency"]))
    $currency = strtolower($_GET["currency"]);
if (isset($_GET["amount"]))
    $amount = $_GET["amount"];
$amount = (float) $amount;
if (isset($_GET["coin"]))
    $coin = $_GET["coin"];
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);

$btcpriceusd = getBTCPriceUsd($coin);

$currency = strtoupper($currency);

if ($currency != 'USD' && $currency != 'BDT') {
    $exchangerate = "https://api.exchangerate.host/latest?base=USD";
    $exchangeratejson = getData($exchangerate);
    $rates = $exchangeratejson->rates->$currency;
} else if ($currency == 'BDT') {
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
            'header' => "Content-type: application/json\r\n" .
            "Content-Length: " . strlen($postData) . "\r\n",
            'method' => 'POST',
            'content' => $postData
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $exratejsonArray = json_decode($result);
    $rates = $exratejsonArray->data[0]->referencePrice;
}

$str = $amount * $btcpriceusd * $rates;
$string = number_format($str, 2);
$string = $string . " " . $currency;


header('Content-type: image/gif'); // filetype

$font = 4;
$width = (imagefontwidth($font) * strlen($string)) + 3;
$height = (imagefontheight($font) - 1);

$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 199, 200, 210);
imagecolortransparent($image, $white);
imagefill($image, 0, 0, $white);

$textcolor = allocateHexColor($image, $hex);
imagestring($image, $font, 0, 0, $string, $textcolor);
if (isset($_GET["bold"])) {
    imagestring($image, $font, 1, 0, $string, $textcolor);
    imagestring($image, $font, 0, 1, $string, $textcolor);
    imagestring($image, $font, 1, 1, $string, $textcolor);
    $height = (imagefontheight($font)+1);
}

header('Content-type: image/gif');

imagegif($image, 'localprice.gif');

readfile('localprice.gif');
imagedestroy($image); // free up memory
exit;

?>