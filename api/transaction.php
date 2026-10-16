<?php
require "functions.php";

header('Cache-Control: max-age=30');

$hex = "000";
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);
if (isset($_GET["id"]))
    $id = $_GET["id"];

$dataUrl = "https://mempool.space/api/tx/" . $id;
$data = getData($dataUrl);

if (!$data || !isset($data->fee) || !isset($data->vin) || !isset($data->vout)) {
    $string = 'Transaction not found or error loading data';
    $array = [$string];
} else {
    $price = getBTCPriceUsd('bitcoin');
    $price = ($price !== false && $price !== null) ? $price : 0;

    // Fee //
    $fee = ($data->fee) / 100000000;
    $fee = 'fee: ' . number_format($fee, 8) . ' $' . number_format($price * $fee, 2);

    // Fee Rate //
    $weight = isset($data->weight) && $data->weight > 0 ? ($data->weight / 4) : 1;
    $fee_rate = ($data->fee) / $weight;
    $fee_rate = 'fee rate: ' . number_format($fee_rate, 2) . ' sat/vB';

    // confirmed //
    $confirmed = (isset($data->status->confirmed) && $data->status->confirmed == 1) 
        ? 'confirmed /n block height: ' . ($data->status->block_height ?? '') . '/n blocktime: ' . date('Y-m-d H:i:s', $data->status->block_time ?? time())
        : 'unconfirmed';

    //id//
    $idstring = 'transaction id: ' . substr($id, 0, 10) . '...' . substr($id, -10);

    // inputs //
    $inputs = array();
    foreach ($data->vin as $element) {
        if (isset($element->prevout->scriptpubkey_address)) {
            $inputs[] = '   ' . substr($element->prevout->scriptpubkey_address, 0, 10) . '...' . substr($element->prevout->scriptpubkey_address, -10)
                . ' ' . ($element->prevout->value) / 100000000 . ' $' . number_format($price * ($element->prevout->value / 100000000), 2) . '/n';
        } else if (isset($element->is_coinbase) && $element->is_coinbase == true) {
            $decoded_message = isset($element->scriptsig) ? hex2bin($element->scriptsig) : '';
            $inputs[] =  '   ' . 'coinbase tx - ' . $decoded_message . '/n';
        }
    }
    // outputs //
    $outputs = array();
    foreach ($data->vout as $element) {
        if (isset($element->scriptpubkey_address)) {
            $outputs[] = '   ' . substr($element->scriptpubkey_address, 0, 10) . '...' . substr($element->scriptpubkey_address, -10)
                . ' ' . ($element->value) / 100000000 . ' $' . number_format($price * ($element->value / 100000000), 2) . '/n';
        } else if (isset($element->scriptpubkey_type) && $element->scriptpubkey_type == 'op_return') {
            $message = explode(' ', $element->scriptpubkey_asm ?? '');
            $op_return = reset($message);
            $decoded_message = hex2bin(array_pop($message));
            $outputs[] = '   ' . $op_return . ' ' . $decoded_message . ' ' . ($element->value) / 100000000 . ' $' . number_format($price * ($element->value / 100000000), 2) . '/n';
        }
    }
    $string = $idstring . '/n' . $confirmed . '/n' . $fee . '/n' . $fee_rate . '/n /n' . 'inputs: /n' . implode($inputs) . '/n' . 'outputs: /n' . implode($outputs);
    $array = explode('/n', $string);
    array_pop($array);
}

$font = 4;
$width = 500;
$height = (imagefontheight($font) - 0.7) * (count($array));

$image = imagecreatetruecolor($width, $height);
$textcolor = allocateHexColor($image, $hex);
$white = imagecolorallocate($image, 199, 200, 210);
imagecolortransparent($image, $white);

imagefill($image, 0, 0, $white);

foreach ($array as $i => $st) {
    imagestring($image, $font, 10, ($i + 0.7) * ($font + 10), $st, $textcolor);
    if (isset($_GET["bold"])) {
        imagestring($image, $font, 11, ($i + 0.7) * ($font + 10), $st, $textcolor);
        imagestring($image, $font, 10, ($i + 0.7) * ($font + 10) + 1, $st, $textcolor);
        imagestring($image, $font, 11, ($i + 0.7) * ($font + 10) + 1, $st, $textcolor);
    }
}

header('Content-type: image/gif');

imagegif($image);
imagedestroy($image); // free up memory
exit;