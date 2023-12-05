<?php

namespace App\Domain;

use App\Domain\Entity\Game;
use App\Domain\Entity\Number;
use App\Domain\Entity\Symbols;

class ProcessDomain
{

    protected $debugEnabled = false;


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
        $sum = 0;

        foreach ($lineList as $lineLoop) {

            $gameLoop = new Game($lineLoop);

            $this->printDebug($gameLoop);

            $sum += $gameLoop->getScore();
        }


        return $sum;
    }
}
