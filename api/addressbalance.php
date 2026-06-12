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
if ($currency === "NOFIAT")
    $rates = 1;
else
    $rates = getFiatRates($currency);

$price = $btcpriceusd * $rates;

if (isset($_GET["receivedfromothers"])) {
    $dataUrl = "https://mempool.space/api/address/" . $address . "/txs";
    $explorerjsonArray = getData($dataUrl);
    $addressbalance = 0;
    foreach ($explorerjsonArray as $transaction) {
        $isFromSelf = false;
        // Check if the address is in any of the transaction's inputs.
        foreach ($transaction->vin as $input) {
            if (isset($input->prevout->scriptpubkey_address) && $input->prevout->scriptpubkey_address === $address) {
                $isFromSelf = true;
                break; // Found the address in inputs
            }
        }
        // Sum the values of all outputs sent to this address that are not from the address itself.
        if (!$isFromSelf) {
            foreach ($transaction->vout as $output) {
                if (isset($output->scriptpubkey_address) && $output->scriptpubkey_address === $address) {
                    $addressbalance += $output->value;
                }
            }
        }
    }
    $addressbalance = $addressbalance / 100000000;
} else {
$dataUrl = "https://mempool.space/api/address/" . $address;
$explorerjsonArray = getData($dataUrl);

$addressbalance = ($explorerjsonArray->chain_stats->funded_txo_sum - $explorerjsonArray->chain_stats->spent_txo_sum) / 100000000;
if (isset($_GET["totalreceived"])) {
    $addressbalance = $explorerjsonArray->chain_stats->funded_txo_sum / 100000000;
}
}

$addressvalue = number_format($addressbalance * $price, 2);

if ($currency === "NOFIAT")
    $string = $address . " " . number_format($addressbalance, 8) . " BTC";
else
    $string = $address . " " . number_format($addressbalance, 8) . " BTC - " . $addressvalue . " " . $currency;

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