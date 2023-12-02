<?php

require('domain/ProcessDomain.php');

$process = new ProcessDomain();



$lineList = file(__DIR__ . '/../input.txt');
//$lineList = file('./example.txt');

$process->enableDebug();

$sum = $process->processLineList($lineList);
echo $sum;
