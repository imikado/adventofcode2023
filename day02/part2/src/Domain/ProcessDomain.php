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

    public function processLineList(array $lineList)
    {

        $colorList = [Game::COLOR_BLUE, Game::COLOR_GREEN, Game::COLOR_RED];

        $gameList = $this->convertToGameList($lineList);
        foreach ($gameList as $gameLoop) {

            $productLoop = 1;

            foreach ($colorList as $colorLoop) {
                $minimumLoop = $gameLoop->getMinimumNumberByCubeColor($colorLoop);
                if ($minimumLoop > 0) {
                    $productLoop *= $minimumLoop;
                }
            }


            $this->printDebug($gameLoop, 'gameLoop');

            $this->sum += $productLoop;

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
