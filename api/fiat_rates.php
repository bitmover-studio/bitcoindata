<?php
require "functions.php";

//update rates
getFiatRates('BRL');

// stored rates
$storedPricefile = 'rates.json';

$rates = file_get_contents($storedPricefile);

echo $rates;