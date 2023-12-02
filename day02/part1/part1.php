<?php

require_once(__DIR__ . '/vendor/autoload.php');

use App\Domain\Entity\Game;
use App\Domain\ProcessDomain;

$process = new ProcessDomain();


$lineList = file(__DIR__ . '/../input.txt');
//$lineList = file(__DIR__ . '/../example.txt');

$process->enableDebug();

$mandatoryColorList = [
    Game::COLOR_RED => 12,
    Game::COLOR_GREEN => 13,
    Game::COLOR_BLUE => 14


];
$sum = $process->processLineListFormMandatoryList($lineList, $mandatoryColorList);
echo $sum;
