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

if ($rates == 0 || $rates == null || $rates == false) {
    $rates = 1;
}
$str = $fiatamount / ($btcpriceusd * $rates);
$string = number_format($str, 8);
if (strtolower($coin) === 'bitcoin') {
    $string = $string . " BTC";
} else {
    $string = $string;
}

header('Content-type: image/gif'); // filetype

$font = 4;
$width = (imagefontwidth($font) * strlen($string)) + 3;
$height = (imagefontheight($font) - 1);

if (isset($_GET["date"])) {
    $height = 2 * (imagefontheight($font) - 1);
} elseif (isset($_GET["bold"])) {
    $height = (imagefontheight($font) + 1);
}

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
}

printDate($image, $height, $textcolor);

header('Content-type: image/gif');

$filenameParts = ['fiattobtc'];
if (isset($coin)) $filenameParts[] = $coin;
if (isset($currency)) $filenameParts[] = $currency;
if (isset($fiatamount)) $filenameParts[] = $fiatamount;
if (isset($hex)) $filenameParts[] = $hex;
if (isset($_GET['date'])) $filenameParts[] = 'date';
if (isset($_GET['bold'])) $filenameParts[] = 'bold';
$filename = implode('_', $filenameParts) . '.gif';

imagegif($image, $filename);

readfile($filename);
imagedestroy($image); // free up memory
exit;

?>