<?php

namespace Console;

use Matrix\Matrix;

class Console
{
    private $matrix;

    /**
     * Console constructor.
     * @param Matrix $matrix
     */
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }
    public function printPrimes()
    {
        $primes = $this->matrix->searchPrimes();

        echo 'There are ' . count($primes) . " prime numbers \n";
        $primes = array_chunk($primes, 5);
        foreach ($primes as $primeChunk) {
            echo implode(', ', $primeChunk) . "\n";
        }
    }
}