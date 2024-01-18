<?php
require_once 'functions.php';

// Declare $data as a global variable array
global $data;
$data = array();
$times = array();

// Set default timezone to UTC
date_default_timezone_set('UTC');

function drawChart()
{
    $blockFeeRatesUrl = "https://mempool.space/api/v1/mining/blocks/fee-rates/3d";
    $responsejson = getRawData($blockFeeRatesUrl);
    $blockFeeRates = json_decode($responsejson);
    
    global $data;
    global $times;
    array_push($times,$blockFeeRates[0]->timestamp);
    array_push($times,$blockFeeRates[count($blockFeeRates)/2]->timestamp); 
    foreach($blockFeeRates as $i) {
        array_push($data,$i->avgFee_50);
    }
}
drawChart();
// Create a new image with a width of 500 pixels and a height of 300 pixels
$image = imagecreatetruecolor(520, 280);

// Set the background color of the image to transparent
$background = imagecolorallocate($image, 255, 255, 255);
imagecolortransparent($image, $background);

// Set the line and point colors
$line_color = imagecolorallocate($image, 0,143,251);
$axis_color = imagecolorallocate($image, 201,201,201);
$point_color = imagecolorallocate($image, 255, 0, 0);

// Fill the background with the background color
imagefill($image, 0, 0, $background);

// Draw the x and y axis
imageline($image, 60, 250, 460, 250, $axis_color);
imageline($image, 60, 250, 60, 50, $axis_color);

// Draw the minimum, and maximum values on the y-axis
$font_color = imagecolorallocate($image, 50, 50, 50);
$font_size = 8;
$fontpath= realpath('arial.ttf');
$max_label = number_format(max($data), 0).' sat/vB';
$middle_label = number_format(max($data)/2, 0).' sat/vB';
imagettftext($image, $font_size, 0, 7, 250, $font_color, $fontpath, '0 sat/vB');
imagettftext($image, $font_size, 0, 7, 150, $font_color,  $fontpath, $middle_label);
imagettftext($image, $font_size, 0, 7, 50, $font_color, $fontpath, $max_label);
imagettftext($image, 13, 0, 120, 20, $font_color, $fontpath, 'Average fee rate per block - last 3 days');
imagettftext($image, 9, 0, 300, 35, $font_color, $fontpath, 'https://bitcoindata.science');
imagettftext($image, 7, 0, 60, 260, $font_color, $fontpath, date('m/d/Y H:i', $times[0]) . ' ' . date_default_timezone_get());
imagettftext($image, 7, 0, 255, 260, $font_color, $fontpath, date('m/d/Y H:i', $times[1]) . ' ' . date_default_timezone_get());
imagettftext($image, 7, 0, 400, 260, $font_color, $fontpath, date('m/d/Y H:i', time()) . ' ' . date_default_timezone_get());

// Draw the Lines
$x = 60;
$y = 250;
for ($i = 0; $i < count($data); $i++) {
    $y1 = $y - ($data[$i] - 1) / (max($data) - 1) * 200;
    if ($i == count($data) - 1) {
        $label = number_format($data[$i], 0);
        imagettftext($image, $font_size, 0, $x -5, $y1 +6, $font_color, $fontpath, $label.'sat/vB');
    }
    //
    // imagefilledellipse($image, $x, $y1, 10, 10, $point_color);
    if ($i > 0) {
        $y2 = $y - ($data[$i - 1] - 1) / (max($data) - 1) * 200;
        imageline($image, $x - 1, $y2, $x, $y1, $line_color);
    }
    $x += 1;
}

// Draw the ticks on the x-axis
$x1 =  count($data)/2+60;
imageline($image, $x1, $y, $x1, $y - 10, imagecolorallocate($image, 201,201,201));
imageline($image, 460, $y, 460, $y - 10, imagecolorallocate($image, 201,201,201));

// Output the chart as a gif image
header('Content-Type: image/gif');
imagepng($image);
imagegif($image, 'chart.gif');
imagedestroy($image);