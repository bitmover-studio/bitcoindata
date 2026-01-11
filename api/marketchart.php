<?php
require_once 'functions.php';

function getBinanceBackup() {
    $binanceUrl = "https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1d&limit=10";
    
    $raw = @file_get_contents($binanceUrl);
    if ($raw === false) {
        return false;
    }
    
    $klines = json_decode($raw, true);
    if (!is_array($klines)) {
        return false;
    }
    
    // Convert to Coingecko format [[timestamp_ms, close_price], ...]
    $prices = [];
    foreach ($klines as $kline) {
        $prices[] = [
            $kline[0], // open_time ms
            floatval($kline[4]) // close price
        ];
    }
    
    return $prices;
}

function updateHistoricalDB()
{
    $coinGeckoApi = 'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=10&interval=daily&precision=2&x_cg_demo_api_key=' . getenv('COINGECKO_API_KEY');
    $storedPricefile = 'historical_prices.json';

    if (file_exists($storedPricefile) && (time() - filemtime($storedPricefile)) < 24 * 60 * 60) { // 24 hours
        $existingData = json_decode(file_get_contents($storedPricefile));
        return json_encode($existingData);
    } else {
        $response = getData($coinGeckoApi);

        if (is_string($response)) {
            $response = json_decode($response);
        }

        if ($response === null || !is_object($response) || !isset($response->prices)) {
            // FALLBACK: Binance
            $apiData = getBinanceBackup();
            if (!$apiData) {
                return json_encode(['error' => 'CoinGecko and Binance failed']);
            }

        } else {
            //Coingecko response
            $apiRawData = $response->prices;
            $apiData = array_slice($apiRawData, 0, -1); // remove last (incompleto)
        }

        // Load historical data
        $existingData = [];
        if (file_exists($storedPricefile)) {
            $json = file_get_contents($storedPricefile);
            if ($json !== false && $json !== '') {
                $existingData = json_decode($json, true) ?: [];
            }
        }

        // Compare timestamps
        $lastRecordTimestamp = end($existingData)[0] ?? 0;
        $newestRecordTimestamp = end($apiData)[0];
        $timeDifference = $newestRecordTimestamp - $lastRecordTimestamp;

        if ($timeDifference >= 86400000) { // 24h in ms
            $existingTimestamps = array_column($existingData, 0);

            foreach ($apiData as $apiRecord) {
                $apiTimestamp = $apiRecord[0];
                if (!in_array($apiTimestamp, $existingTimestamps)) {
                    array_push($existingData, $apiRecord);
                }
            }
            // Save updated data
            file_put_contents($storedPricefile, json_encode($existingData));
        }

        return json_encode($existingData);
    }
}

$historicalPricesJson = updateHistoricalDB();
echo $historicalPricesJson;
?>
