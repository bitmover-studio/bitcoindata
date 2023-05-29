<?php

header( 'Cache-Control: max-age=45' );
$currency="usd";

if(isset($_GET["address"])) $address=$_GET["address"];
if(isset($_GET["currency"])) $currency = strtolower($_GET["currency"]);


$link="https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";
$json=file_get_contents($link);
$jsonArray=json_decode($json);

$exchangerate="https://api.exchangerate.host/latest?base=USD";
$exchangeratejson=file_get_contents($exchangerate);
$exratejsonArray=json_decode($exchangeratejson);

$currency=strtoupper($currency);
$rates = $exratejsonArray->rates->$currency;

$price = $jsonArray->bitcoin->usd;
$price=$price*$rates;

$explorer="https://mempool.space/api/address/".$address;
$explorerjson=file_get_contents($explorer);
$explorerjsonArray=json_decode($explorerjson);

$addressbalance = ($explorerjsonArray->chain_stats->funded_txo_sum - $explorerjsonArray->chain_stats->spent_txo_sum) / 100000000;
$addressvalue = number_format($addressbalance * $price , 2);

$string = $address. " " .$addressbalance." BTC - ".$addressvalue." ".$currency;


header('Content-type: image/png'); // filetype

$font  = 4;
$width  =(imagefontwidth($font) * strlen($string))+3;
$height = (imagefontheight($font));

$image = imagecreatetruecolor ($width,$height);
$black = imagecolorallocate ($image,112,112,112);
$white = imagecolorallocate($image, 255, 255, 255);
imagecolortransparent($image, $white);

imagefill($image,0,0,$white);


imagestring ($image,$font,0,0,$string,$black);


header('Content-type: image/gif');

imagegif($image, 'transaction.gif');

readfile('transaction.gif');
imagedestroy($image); // free up memory
imagedestroy($image); // free up memory
exit;
