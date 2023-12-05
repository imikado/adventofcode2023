<?php

namespace App\Domain\Entity;

class Game
{
    protected $id;

    protected $winningNumber = 0;

    //Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
    public function __construct(string $line)
    {
        list($cardId, $numbersString) = explode(':', $line);
        list($winningNumberString, $playerNumberString) = explode(' | ', $numbersString);

        $winningNumberString = '#' . str_replace(' ', '#', $winningNumberString) . '#';

        if (preg_match_all('/([0-9]+)/', $playerNumberString, $matchList)) {
            foreach ($matchList[1] as $playerNumberLoop) {
                if (str_contains($winningNumberString, '#' . trim($playerNumberLoop) . '#')) {
                    $this->winningNumber += 1;
                }
            }
        }
    }

    public function getScore(): int
    {

        if ($this->winningNumber === 0) {
            return 0;
        }

        return pow(2, $this->winningNumber - 1);
    }
}
