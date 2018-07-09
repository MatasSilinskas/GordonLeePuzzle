<?php

use Console\Console;
use Matrix\Matrix;
use NumberLogic\PrimeNumberChecker;

spl_autoload_register(function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
});

$checker = new PrimeNumberChecker();
$ini = parse_ini_file('config.ini');
$matrix = new Matrix($checker, $ini['matrix']);

$console = new Console($matrix);
$console->printPrimes();
