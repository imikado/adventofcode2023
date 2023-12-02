<?php

namespace App\Domain\Entity;

class GameIteration
{
    //3 blue, 4 red

    public $cubeList = [];

    public function __construct(string $rawIteration)
    {
        $rawCubeList = explode(',', $rawIteration);
        foreach ($rawCubeList as $rawCubeLoop) {
            list($number, $cubeColor) = explode(' ', trim($rawCubeLoop));
            $this->cubeList[$cubeColor] = $number;
        }
    }

    public function getNumberOfCubeColor(string $cubeColor)
    {
        if (array_key_exists($cubeColor, $this->cubeList)) {
            return $this->cubeList[$cubeColor];
        }
        return 0;
    }
}
