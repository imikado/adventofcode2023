<?php

namespace App\Domain;

use App\Domain\Entity\Game;

class ProcessDomain
{
    protected $sum;

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

    public function processLineListFormMandatoryList(array $lineList, array $mandaryColorList)
    {

        $gameList = $this->convertToGameList($lineList);
        foreach ($gameList as $gameLoop) {

            foreach ($mandaryColorList as $mandaryColorLoop => $mandaryColorNumberLoop) {
                if (!$gameLoop->canPlayWithNumberOfCubeColor($mandaryColorNumberLoop, $mandaryColorLoop)) {
                    continue 2;
                }
            }


            $this->printDebug($gameLoop, 'gameLoop');

            $this->sum += $gameLoop->id;

            $this->printDebug($this->sum, '=');
        }

        return $this->sum;
    }

    public function convertToGameList(array $lineList)
    {
        $gameList = [];
        foreach ($lineList as $lineLoop) {

            $gameList[] = new Game($lineLoop);
        }
        return $gameList;
    }
}
