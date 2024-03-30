<?
require_once 'functions.php';
function updateHistoricalDB()
{
    $coinGeckoApi = 'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=10&interval=daily&precision=2';
    $storedPricefile = 'historical_prices.json';

    if (file_exists($storedPricefile) && (time() - filemtime($storedPricefile)) < 1) { //file younger than 8 hours
        $existingData = json_decode(file_get_contents($storedPricefile));
        return json_encode($existingData); // Return the file contents as JSON
    } else {
        $response = getData($coinGeckoApi);
        $apiRawData = $response->prices;
        $apiData = array_slice($apiRawData, 0, -1); // remove last record from API response, because it is not exactly 24h newer
        $existingData = json_decode(file_get_contents($storedPricefile));

        // Compare timestamps
        $lastRecordTimestamp = end($existingData)[0];
        $newestRecordTimestamp = end($apiData)[0];
        $timeDifference = $newestRecordTimestamp - $lastRecordTimestamp;

        if ($timeDifference >= 86400000) { // 24 hours in milliseconds
            // Append new records to existing data
            $existingTimestamps = array_column($existingData, 0);

            foreach ($apiData as $apiRecord) {
                $apiTimestamp = $apiRecord[0];
                if (!in_array($apiTimestamp, $existingTimestamps)) {
                    // Timestamp doesn't exist in existing data, add it
                    array_push($existingData, $apiRecord);
                }
            }
            // Save updated data to your file
            file_put_contents($storedPricefile, json_encode($existingData));
        } else {
            return json_encode($existingData);
        }
    }
}

$historicalPricesJson = updateHistoricalDB();
echo $historicalPricesJson;