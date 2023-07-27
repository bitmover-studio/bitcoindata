<?php
require "functions.php";

header('Cache-Control: max-age=30');

if (isset($_GET["id"]))
    $id = $_GET["id"];

$dataUrl = "https://mempool.space/api/tx/" . $id;
$data = getData($dataUrl);

$price = getBTCPriceUsd('bitcoin');

// Fee //
$fee = ($data->fee) / 100000000;
$fee = 'fee: ' . number_format($fee, 8) . ' $' . number_format($price * $fee, 2);

// Fee Rate //
$fee_rate = ($data->fee) / (($data->weight) / 4);
$fee_rate = 'fee rate: ' . number_format($fee_rate, 2) . ' sat/vB';

// confirmed //
$confirmed = ($data->status->confirmed == 1) ? 'confirmed /n block height: ' . $data->status->block_height . '/n blocktime: ' . date('Y-m-d H:i:s', $data->status->block_time)
    : 'unconfirmed';

//id//
$idstring = 'transaction id: ' . substr($id, 0, 10) . '...' . substr($id, -10);

// inputs //
$inputs = array();
foreach ($data->vin as $element) {
    if (isset($element->prevout->scriptpubkey_address)) {
        $inputs[] = '   ' . substr($element->prevout->scriptpubkey_address, 0, 10) . '...' . substr($element->prevout->scriptpubkey_address, -10)
            . ' ' . ($element->prevout->value) / 100000000 . ' $' . number_format($price * ($element->prevout->value / 100000000), 2) . '/n';
    }
}
// outputs //
$outputs = array();
foreach ($data->vout as $element) {
    if (isset($element->scriptpubkey_address)) {
        $outputs[] = '   ' . substr($element->scriptpubkey_address, 0, 10) . '...' . substr($element->scriptpubkey_address, -10)
            . ' ' . ($element->value) / 100000000 . ' $' . number_format($price * ($element->value / 100000000), 2) . '/n';
    }
}
$string = $idstring . '/n' . $confirmed . '/n' . $fee . '/n' . $fee_rate . '/n /n' . 'inputs: /n' . implode($inputs) . '/n' . 'outputs: /n' . implode($outputs);
$array = explode('/n', $string);
array_pop($array);

$font = 4;
$width = 500;
$height = (imagefontheight($font)-0.7) * (count($array));

$image = imagecreatetruecolor($width, $height);
$black = imagecolorallocate($image, 112, 112, 112);
$white = imagecolorallocate($image, 255, 255, 255);
imagecolortransparent($image, $white);

imagefill($image, 0, 0, $white);

foreach ($array as $i => $st) {
    imagestring($image, $font, 10, ($i + 0.7) * ($font + 10), $st, $black);
}

header('Content-type: image/gif');

imagegif($image, 'transaction.gif');

readfile('transaction.gif');
imagedestroy($image); // free up memory
exit;