<?php

namespace App\Domain\Entity;

class Game
{

    //Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
    const COLOR_RED = 'red';
    const COLOR_BLUE = 'blue';
    const COLOR_GREEN = 'green';

    public $id;

    public $iterationList = [];

    public function __construct(string $line)
    {
        list($rawGameId, $rawGameResult) = explode(':', $line);
        list($foo, $gameId) = explode(' ', $rawGameId);

        $rawGameIterationList = explode(';', $rawGameResult);
        foreach ($rawGameIterationList as $rawIterationLoop) {

            $this->iterationList[] = new GameIteration($rawIterationLoop);
        }

        $this->id = $gameId;
    }

    public function getIteration(int $iteration)
    {
        return $this->iterationList[$iteration];
    }

    public function getMinimumNumberByCubeColor(string $color)
    {
        $minimum = 0;
        foreach ($this->iterationList as $gameIterationLoop) {
            /**
             * @var GameIteration $gameIterationLoop
             */
            if ($gameIterationLoop->getNumberOfCubeColor($color) > $minimum) {
                $minimum = $gameIterationLoop->getNumberOfCubeColor($color);
            }
        }
        return $minimum;
    }
}
