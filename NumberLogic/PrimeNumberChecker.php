<?php

namespace NumberLogic;

class PrimeNumberChecker
{
    public function isPrime(int $number) : bool
    {
        if ($number == 2) {
            return true;
        }

        if ($number == 1 || $number % 2 == 0) {
            return false;
        }

        $ceil = ceil(sqrt($number));
        for($i = 3; $i <= $ceil; $i = $i + 2) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }
}