<?php

namespace App\Domain;

use App\Domain\Entity\Number;
use App\Domain\Entity\StarSymbols;

class ProcessDomain
{
    protected $sum;

    protected $debugEnabled = false;

    protected $savedSymbolList = [];
    protected $numberList = [];
    protected $currentNumber = 0;

    protected $starSymbols = null;

    protected $starSymbolNumberList = [];

    const VALUE_STAR = '*';

    public function enableDebug()
    {
        $this->debugEnabled = true;
    }

    protected function printDebug($mixed, $info = null)
    {
        if ($this->debugEnabled) {
            print("\n");
            if ($info) {
                print ($info) . ': ';
            }
            if (is_string($mixed)) {
                print($mixed);
            } else {
                print_r($mixed);
            }
            print("\n");
        }
    }

    public function processLineList(array $lineList)
    {
        $this->starSymbols = new StarSymbols();

        $this->loadNumberListForLineList($lineList);
        $this->addNumberOnEachStart();

        $this->printDebug($this->starSymbolNumberList);

        foreach ($this->starSymbolNumberList as $starSymbolNumberList) {

            $this->printDebug($starSymbolNumberList);

            if (count($starSymbolNumberList) == 2) {
                $product = $starSymbolNumberList[0]->getValue() * $starSymbolNumberList[1]->getValue();

                $this->sum += $product;
            }

            $this->printDebug($this->sum, '=');
        }

        return $this->sum;
    }

    public function addNumberOnEachStart()
    {

        foreach ($this->numberList as $numberLoop) {

            /**
             * @var Number $numberLoop
             */

            $this->printDebug($numberLoop);

            if ($numberLoop->hasAdjacentStarSymbol($this->starSymbols)) {

                $adjacentStarSymbolList = $numberLoop->getAdjacentStarSymbolList();
                foreach ($adjacentStarSymbolList as $adjacentStarSymbolLoop) {
                    if (!isset($this->starSymbolNumberList[$adjacentStarSymbolLoop])) {
                        $this->starSymbolNumberList[$adjacentStarSymbolLoop] = [];
                    }
                    $this->starSymbolNumberList[$adjacentStarSymbolLoop][] = $numberLoop;
                }
            }
        }
    }

    public function loadNumberListForLineList(array $lineList)
    {
        foreach ($lineList as $y => $lineLoop) {

            $maxXLoop = strlen(trim($lineLoop));
            for ($x = 0; $x < $maxXLoop; $x++) {

                $valueLoop = $lineLoop[$x];

                if (is_numeric($valueLoop)) {
                    if (!$this->hasCurrentNumber()) {
                        $this->createNumberOnCoordXY($x, $y);
                    }
                    $this->getCurrentNumber()->add($lineLoop[$x]);
                } else {
                    if ($this->hasCurrentNumber()) {
                        $this->incrementCurrentNumber();
                    }

                    if ($valueLoop === self::VALUE_STAR) {
                        $this->starSymbols->addCoordXY($x, $y);
                    }
                }
            }
        }
    }

    protected function incrementCurrentNumber(): void
    {
        $this->currentNumber += 1;
    }

    protected function getCurrentNumber(): Number
    {
        return $this->numberList[$this->currentNumber];
    }

    protected function createNumberOnCoordXY($x, $y)
    {
        $this->numberList[$this->currentNumber] = new Number($x, $y);
    }

    protected function hasCurrentNumber(): bool
    {
        return isset($this->numberList[$this->currentNumber]);
    }
}
