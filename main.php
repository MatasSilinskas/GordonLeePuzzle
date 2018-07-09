<?php

use Matrix\Matrix;
use NumberLogic\PrimeNumberChecker;

spl_autoload_register(function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
});

$checker = new PrimeNumberChecker();
$matrix = new Matrix($checker);
$primes = $matrix->searchPrimes();
echo 'There are ' . count($primes) . " prime numbers \n";
$primes = array_chunk($primes, 5);
foreach ($primes as $primeChunk) {
    echo implode(', ', $primeChunk) . "\n";
}