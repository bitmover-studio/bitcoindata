<?php

function getData($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode != 200 || $data === false) {
        return false;
    }
    return json_decode($data);
}

function getRawData($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    if ($data === false) {
        return false;
    }
    return $data;
}

function getBTCPriceUsd($coin)
{
    $priceUrl = "https://api.coingecko.com/api/v3/simple/price?ids=" . $coin . '&vs_currencies=usd';
    $backupPriceUrl = 'https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT';
    $storedPricefile = 'priceusd.json';

    if (file_exists($storedPricefile) && (time() - filemtime($storedPricefile)) < 3 * 60) { //file younger than 3 minutes
        $data = json_decode(file_get_contents($storedPricefile));
        $btcpriceusd = $data->price;
    } else {
        $data = getData($priceUrl);
        if ($data === false) {
            $data = getData($backupPriceUrl);
            $btcpriceusd = (float) $data->lastPrice;
        } else {
            $btcpriceusd = $data->$coin->usd;
        }
        $data = ['price' => $btcpriceusd];
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('priceusd.json', $json);
    }
    return $btcpriceusd;
}

?>