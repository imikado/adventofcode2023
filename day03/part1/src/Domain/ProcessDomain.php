<?php

namespace App\Domain;

use App\Domain\Entity\Number;
use App\Domain\Entity\Symbols;

class ProcessDomain
{
    protected $sum;

    protected $debugEnabled = false;

    protected $savedSymbolList = [];
    protected $numberList = [];
    protected $currentNumber = 0;

    protected $symbols = null;

    const VALUE_PERIOD = '.';

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
        $this->symbols = new Symbols();

        $this->loadNumberListForLineList($lineList);

        $this->printDebug($this->symbols);

        foreach ($this->numberList as $numberLoop) {

            /**
             * @var Number $numberLoop
             */

            $this->printDebug($numberLoop);

            if ($numberLoop->hasAdjacentSymbol($this->symbols)) {
                $this->printDebug($numberLoop->getValue(), '+');
                $this->sum += $numberLoop->getValue();
            } else {
                $this->printDebug($numberLoop->getValue(), '---');
            }



            $this->printDebug($this->sum, '=');
        }

        return $this->sum;
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

                    if ($valueLoop !== self::VALUE_PERIOD) {
                        $this->symbols->addCoordXY($x, $y);
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
