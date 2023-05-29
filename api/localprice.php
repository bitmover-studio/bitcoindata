<?php
//forked from https://github.com/edgycorner/Coin-Price-Image-generator/

header( 'Cache-Control: max-age=45' );
$coin="bitcoin";
$currency="usd";
$amount=1;

if(isset($_GET["currency"])) $currency = strtolower($_GET["currency"]);
if(isset($_GET["amount"])) $amount=$_GET["amount"];
if(isset($_GET["coin"])) $coin=$_GET["coin"];
$amount =(float)$amount;


$famount=(float)$amount;

$link="https://api.coingecko.com/api/v3/simple/price?ids=".$coin.'&vs_currencies=usd';
$json=file_get_contents($link);
$jsonArray=json_decode($json);

$exchangerate="https://api.exchangerate.host/latest?base=USD";
$exchangeratejson=file_get_contents($exchangerate);
$exratejsonArray=json_decode($exchangeratejson);

$currency=strtoupper($currency);
$rates = $exratejsonArray->rates->$currency;


$str = $jsonArray->$coin->usd;
$str=$amount*$str*$rates;
$string = number_format($str , 2);
$string = $string." ".$currency;


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
exit;

?>