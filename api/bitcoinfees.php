<?php

header( 'Cache-Control: max-age=180' );

$response="https://mempool.space/api/v1/fees/recommended";
$responsejson=file_get_contents($response);
$feesjson=str_replace([',','}'], ' sat/vB,', $responsejson);
$feesjson=str_replace(['{'], '', $feesjson);
$feesjson=str_replace(['"'], '', $feesjson);
$feesjson=str_replace([':'], ': ', $feesjson);

$fees_lines = explode(",", $feesjson);

$font_size  = 4;

$image = imagecreatetruecolor (210,100);
$text_color = imagecolorallocate ($image,112,112,112);
$white = imagecolorallocate($image, 255, 255, 255);
imagecolortransparent($image, $white);

imagefill($image,0,0,$white);

foreach ($fees_lines as $i => $fees_line) {
    imagestring($image, $font_size, 10, ($i + 1) * ($font_size + 10), $fees_line, $text_color);
}

// Output the image to the browser
header('Content-Type: image/gif');
imagegif($image);

// Free up memory
imagedestroy($image);
