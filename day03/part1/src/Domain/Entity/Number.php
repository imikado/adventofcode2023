<?php

namespace App\Domain\Entity;

class Number
{
    protected $x = 0;
    protected $y = 0;

    protected $numberString = '';

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

    public function hasAdjacentSymbol(Symbols $symbols)
    {
        for ($y = ($this->y - 1); $y <= ($this->y + 1); $y++) {
            for ($x = ($this->x - 1); $x <= ($this->getXmax() + 1); $x++) {
                if ($symbols->hasCoordXY($x, $y)) {
                    print('found for coord:' . $x . '_' . $y);
                    return true;
                }
            }
        }

        return false;
    }
}
