<?php
require "functions.php";

header('Cache-Control: max-age=45');
$currency = "usd";
$hex = "000";
$rates = 1;

if (isset($_GET["address"]))
    $address = $_GET["address"];
if (isset($_GET["currency"]))
    $currency = strtolower($_GET["currency"]);
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);

$btcpriceusd = getBTCPriceUsd('bitcoin');

$currency = strtoupper($currency);
$rates = getFiatRates($currency);

$price = $btcpriceusd * $rates;

$dataUrl = "https://mempool.space/api/address/" . $address;
$explorerjsonArray = getData($dataUrl);

$addressbalance = ($explorerjsonArray->chain_stats->funded_txo_sum - $explorerjsonArray->chain_stats->spent_txo_sum) / 100000000;
$addressvalue = number_format($addressbalance * $price, 2);

$string = $address . " " . $addressbalance . " BTC - " . $addressvalue . " " . $currency;

//create image

header('Content-type: image/gif'); // filetype

$font = 4;
$width = (imagefontwidth($font) * strlen($string)) + 3;
$height = (imagefontheight($font));

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

imagegif($image, 'addressbalance.gif');

readfile('addressbalance.gif');
imagedestroy($image); // free up memory
exit;