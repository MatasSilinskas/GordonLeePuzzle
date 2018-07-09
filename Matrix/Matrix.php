<?php
namespace Matrix;
use NumberLogic\PrimeNumberChecker;
use SplFileObject;

class Matrix
{
    private $matrix = [];
    private $size;
    private $checker;
    private $steps = [
        [-1, -1],
        [-1, 0],
        [-1, 1],

        [0, -1],
        [0, 1],

        [1, -1],
        [1, 0],
        [1, 1],
    ];

    public function __construct(PrimeNumberChecker $checker)
    {
        $this->checker = $checker;
        $file = new SplFileObject('Matrix/matrix.txt');
        $data = [];
        while (!$file->eof()) {
            $data[] = str_replace("\r\n", '', $file->current());
            $file->next();
        }

        $this->size = array_shift($data);
        for ($i = 0; $i < $this->size; $i++) {
            foreach (str_split($data[$i]) as $item) {
                $this->matrix[$i][] = $item;
            }
        }
    }
    public function searchPrimes() : array
    {
        $primes = [];
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                foreach ($this->steps as $step) {
                    $this->walkStep($step, $row, $col, $primes);
                }
            }
        }

        sort($primes);
        return $primes;
    }

    private function walkStep(array $step, int $row, int $col, array &$primes)
    {
        $curr = $this->matrix[$row][$col];
        $this->addPrime($curr, $primes);
        while (isset($this->matrix[$row + $step[0]][$col + $step[1]])) {
            $curr .= $this->matrix[$row + $step[0]][$col + $step[1]];
            $this->addPrime($curr,$primes);
            $row += $step[0];
            $col += $step[1];
        }
    }
    private function addPrime($value, &$primes)
    {
        if ($this->checker->isPrime($value) && !in_array($value, $primes)) {
            $primes[] = $value;
        }
    }
}