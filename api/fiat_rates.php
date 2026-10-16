<?php
require "functions.php";

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: max-age=60');

// update rates
getFiatRates('BRL');

// stored rates
$storedPricefile = 'rates.json';

if (file_exists($storedPricefile)) {
    echo file_get_contents($storedPricefile);
} else {
    echo json_encode(['error' => 'Rates unavailable']);
}
exit;