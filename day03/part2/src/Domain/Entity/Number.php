<?php

namespace App\Domain\Entity;

class Number
{
    protected $x = 0;
    protected $y = 0;

    protected $numberString = '';
    protected $adjacentStarSymbolList = [];

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function add($digit)
    {
        $this->numberString .= $digit;
    }

    public function getSize()
    {
        return strlen($this->numberString);
    }

    public function getValue(): int
    {
        return (int)$this->numberString;
    }

    public function getXmax()
    {
        return ($this->x + $this->getSize() - 1);
    }

    public function hasAdjacentStarSymbol(StarSymbols $symbols)
    {
        for ($y = ($this->y - 1); $y <= ($this->y + 1); $y++) {
            for ($x = ($this->x - 1); $x <= ($this->getXmax() + 1); $x++) {
                if ($symbols->hasCoordXY($x, $y)) {

                    $this->adjacentStarSymbolList[] = $x . '_' . $y;
                }
            }
        }

        if (count($this->adjacentStarSymbolList) > 0) {
            return true;
        }
        return false;
    }

    public function getAdjacentStarSymbolList()
    {
        return $this->adjacentStarSymbolList;
    }
}
