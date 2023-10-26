<?php
require "functions.php";

header('Cache-Control: max-age=45');
$coin = "bitcoin";
$currency = "usd";
$fiatamount = 1;
$rates = 1;
$hex = "000";

if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);
if (isset($_GET["currency"]))
    $currency = strtolower($_GET["currency"]);
if (isset($_GET["fiatamount"]))
    $fiatamount = $_GET["fiatamount"];
if (isset($_GET["coin"]))
    $coin = $_GET["coin"];
$fiatamount = (float) $fiatamount;

$btcpriceusd = getBTCPriceUsd($coin);

$currency = strtoupper($currency);

$rates = getFiatRates($currency);

$str = $fiatamount / ($btcpriceusd * $rates);
$string = number_format($str, 8);
$string = $string . " BTC";


header('Content-type: image/gif'); // filetype

$font = 4;
$width = (imagefontwidth($font) * strlen($string)) + 3;
$height = (imagefontheight($font)-1);

$image = imagecreatetruecolor($width, $height);
$textcolor = allocateHexColor($image, $hex);
$white = imagecolorallocate($image, 199, 200, 210);
imagecolortransparent($image, $white);

imagefill($image, 0, 0, $white);


imagestring($image, $font, 0, 0, $string, $textcolor);
if (isset($_GET["bold"])) {
    imagestring($image, $font, 1, 0, $string, $textcolor);
    imagestring($image, $font, 0, 1, $string, $textcolor);
    imagestring($image, $font, 1, 1, $string, $textcolor);
    $height = (imagefontheight($font)+1);
}

header('Content-type: image/gif');

imagegif($image, 'fiattobtc.gif');

readfile('fiattobtc.gif');
imagedestroy($image); // free up memory
exit;

?>