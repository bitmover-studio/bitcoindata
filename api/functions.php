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
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode != 200 || $data === false) {
        return false;
    }
    return $data;
}

function getBTCPriceUsd($coin)
{
    $storedPricefile = 'price_' . $coin . '_usd.json';

    // 1. Check for fresh cache file
    if (file_exists($storedPricefile) && (time() - filemtime($storedPricefile)) < 3 * 60) { //younger than 3 minutes
        $data = json_decode(file_get_contents($storedPricefile));
        if (isset($data->price)) {
            return $data->price;
        }
    }

    // 2. Fetch from primary source (CoinGecko)
    $price = null;
    $priceUrl = "https://api.coingecko.com/api/v3/simple/price?ids=" . $coin . '&vs_currencies=usd&x_cg_demo_api_key=' . getenv('COINGECKO_API_KEY');
    $data = getData($priceUrl);

    if ($data !== false && isset($data->$coin) && isset($data->$coin->usd)) {
        $price = $data->$coin->usd;
    } else {
        // 3. Fetch from backup source (Binance) if primary fails
        $symbolMap = [
            'bitcoin' => 'BTCUSDT',
            'monero' => 'XMRUSDT',
            'ethereum' => 'ETHUSDT',
            // Add other coin mappings from CoinGecko ID to Binance Symbol here
        ];

        if (isset($symbolMap[$coin])) {
            $symbol = $symbolMap[$coin];
            $backupPriceUrl = 'https://api.binance.com/api/v3/ticker/24hr?symbol=' . $symbol;
            $backupData = getData($backupPriceUrl);
            if ($backupData !== false && isset($backupData->lastPrice)) {
                $price = (float) $backupData->lastPrice;
            }
        }
    }

    // 4. If a price was found from any source, cache it and return.
    if ($price !== null) {
        $cacheData = ['price' => $price];
        $json = json_encode($cacheData, JSON_PRETTY_PRINT);
        file_put_contents($storedPricefile, $json);
        return $price;
    }

    // 5. If all API calls fail, as a last resort, use a stale cache file if it exists.
    if (file_exists($storedPricefile)) {
        $data = json_decode(file_get_contents($storedPricefile));
        if (isset($data->price)) {
            return $data->price;
        }
    }

    return false; // Indicate failure if no price could be determined
}

function getFiatRates($currency)
{
    $usdcurrency = "USD" . $currency;
    $storedRatesfile = 'rates.json';

    if ($currency != 'USD' && $currency != 'BDT') {
        if (file_exists($storedRatesfile) && (time() - filemtime($storedRatesfile)) < 10 * 60 * 60) { //file younger than 10 hours
            $exchangerate = json_decode(file_get_contents($storedRatesfile));
            $rates = $exchangerate->$usdcurrency;
        } else {
            $exchangerate = "http://api.exchangerate.host/live?access_key=" . getenv("API_KEY");
            $exchangeratejson = getData($exchangerate);
            $data = $exchangeratejson->quotes;
            $json = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('rates.json', $json);
            $rates = $exchangeratejson->quotes->$usdcurrency;
        }
    } else if ($currency == 'BDT') {
        $url = 'https://p2p.binance.com/bapi/c2c/v2/public/c2c/adv/quoted-price';
        $postFields = array(
            'assets' => array('USDT'),
            'fiatCurrency' => 'BDT',
            'tradeType' => 'BUY',
            'fromUserRole' => 'USER'
        );
        $postData = json_encode($postFields);

        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n" .
                    "Content-Length: " . strlen($postData) . "\r\n",
                'method' => 'POST',
                'content' => $postData
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $exratejsonArray = json_decode($result);
        $rates = $exratejsonArray->data[0]->referencePrice;
    } else {
        $rates = 1;
    }
    return $rates;
}

function allocateHexColor($image, $hex)
{
    $red = hexdec(substr($hex, 0, 2));
    $green = hexdec(substr($hex, 2, 2));
    $blue = hexdec(substr($hex, 4, 2));
    return imagecolorallocate($image, $red, $green, $blue);
}

function printDate($image, $height, $textcolor)
{
    if (isset($_GET["date"])) {
        $date = gmdate('Y/m/d H:i') . " UTC";
        imagestring($image, 1.8, 1.8, 1 + ($height / 2), $date, $textcolor);
    }
}