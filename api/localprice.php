<?php
require "functions.php";

header('Cache-Control: max-age=45');
$coin = "bitcoin";
$currency = "usd";
$amount = 1;
$rates = 1;
$hex = "000";
$nocurrency = false;

if (isset($_GET["currency"]))
    $currency = strtolower($_GET["currency"]);
if (isset($_GET["amount"]))
    $amount = $_GET["amount"];
$amount = (float) $amount;
if (isset($_GET["coin"]))
    $coin = $_GET["coin"];
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);
if (isset($_GET["nocurrency"]))
    $nocurrency = filter_var($_GET["nocurrency"], FILTER_VALIDATE_BOOLEAN);

$btcpriceusd = getBTCPriceUsd($coin);

$currency = strtoupper($currency);

$rates = getFiatRates($currency);
if ($rates == 0 || $rates == null || $rates == false) {
    $rates = 1;
}
$str = $amount * $btcpriceusd * $rates;
$string = number_format($str, 2);
if (!$nocurrency) { $string = $string . " " . $currency;}
if ($nocurrency == true) { $string = $string . "";}
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
$white = imagecolorallocate($image, 199, 200, 210);
$textcolor = allocateHexColor($image, $hex);
imagecolortransparent($image, $white);
imagefill($image, 0, 0, $white);

imagestring($image, $font, 0, 0, $string, $textcolor);

if (isset($_GET["bold"])) {
    imagestring($image, $font, 1, 0, $string, $textcolor);
    imagestring($image, $font, 0, 1, $string, $textcolor);
    imagestring($image, $font, 1, 1, $string, $textcolor);
}

printDate($image,$height,$textcolor);

header('Content-type: image/gif');

$filenameParts = ['localprice'];
if (isset($coin)) $filenameParts[] = $coin;
if (isset($currency)) $filenameParts[] = $currency;
if (isset($amount)) $filenameParts[] = $amount;
if (isset($hex)) $filenameParts[] = $hex;
if (isset($_GET['nocurrency']) && $_GET['nocurrency'] !== 'false') $filenameParts[] = 'nocurrency';
if (isset($_GET['date'])) $filenameParts[] = 'date';
if (isset($_GET['bold'])) $filenameParts[] = 'bold';
$filename = implode('_', $filenameParts) . '.gif';

imagegif($image, $filename);

readfile($filename);
imagedestroy($image); // free up memory
exit;

?>