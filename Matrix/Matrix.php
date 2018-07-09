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
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                foreach ($this->steps as $step) {
                    $row = $i;
                    $col = $j;
                    $curr = $this->matrix[$row][$col];
                    $this->addPrime($curr, $primes);
                    while (isset($this->matrix[$row + $step[0]][$col + $step[1]])) {
                        $curr .= $this->matrix[$row + $step[0]][$col + $step[1]];
                        $this->addPrime($curr,$primes);
                        $row += $step[0];
                        $col += $step[1];
                    }
                }
            }
        }

        sort($primes);
        return $primes;
    }

    private function addPrime($value, &$primes)
    {
        if ($this->checker->isPrime($value) && !in_array($value, $primes)) {
            $primes[] = $value;
        }
    }
}