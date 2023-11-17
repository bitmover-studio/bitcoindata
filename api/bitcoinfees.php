<?php
require "functions.php";

header('Cache-Control: max-age=180');

$hex = "000";
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);

$feesUrl = "https://mempool.space/api/v1/fees/recommended";

$responsejson = getRawData($feesUrl);
$feesjson = str_replace([',', '}'], ' sat/vB,', $responsejson);
$feesjson = str_replace(['{'], '', $feesjson);
$feesjson = str_replace(['"'], '', $feesjson);
$feesjson = str_replace([':'], ': ', $feesjson);

$fees_lines = explode(",", $feesjson);

$font = 4;

$image = imagecreatetruecolor(210, 110);
$textcolor = allocateHexColor($image, $hex);
$white = imagecolorallocate($image, 199, 200, 210);
imagecolortransparent($image, $white);

imagefill($image, 0, 0, $white);

foreach ($fees_lines as $i => $fees_line) {
    imagestring($image, $font, 10, ($i + 1) * ($font + 10), $fees_line, $textcolor);
    if (isset($_GET["bold"])) {
        imagestring($image, $font, 11, ($i + 1) * ($font + 10), $fees_line, $textcolor);
        imagestring($image, $font, 10, ($i + 1) * ($font + 10) + 1, $fees_line, $textcolor);
        imagestring($image, $font, 11, ($i + 1) * ($font + 10) + 1, $fees_line, $textcolor);
    }
    $date = gmdate('Y/m/d H:i') . " UTC";
    imagestring($image, 1.8, 1.8, 1 + ($height / 2), $date, $textcolor);
}

// Output the image to the browser
header('Content-Type: image/gif');
imagegif($image, 'bitcoinfees.gif');
readfile('bitcoinfees.gif');

// Free up memory
imagedestroy($image);