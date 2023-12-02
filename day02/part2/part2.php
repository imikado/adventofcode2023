<?php

require_once(__DIR__ . '/vendor/autoload.php');

use App\Domain\ProcessDomain;

$process = new ProcessDomain();

$lineList = file(__DIR__ . '/../input.txt');
//$lineList = file(__DIR__ . '/../example.txt');

$process->enableDebug();


$sum = $process->processLineList($lineList);
echo $sum;
