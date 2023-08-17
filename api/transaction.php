<?php
require "functions.php";

header('Cache-Control: max-age=30');

$hex = "707070";
if (isset($_GET["hex"]))
    $hex = strtolower($_GET["hex"]);
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
    } else if ($element->scriptpubkey_type == 'op_return') {
        $message = explode(' ', $element->scriptpubkey_asm);
        $op_return = reset($message);
        $decoded_message = hex2bin(array_pop($message));
        $outputs[] = '   ' . $op_return . ' ' . $decoded_message . ' ' . ($element->value) / 100000000 . ' $' . number_format($price * ($element->value / 100000000), 2) . '/n';
    }
}
$string = $idstring . '/n' . $confirmed . '/n' . $fee . '/n' . $fee_rate . '/n /n' . 'inputs: /n' . implode($inputs) . '/n' . 'outputs: /n' . implode($outputs);
$array = explode('/n', $string);
array_pop($array);

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

imagegif($image, 'transaction.gif');

readfile('transaction.gif');
imagedestroy($image); // free up memory
exit;