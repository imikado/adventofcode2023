<?php

namespace App\Domain\Entity;

class StarSymbols
{

    protected $savedSymbolList = [];

    public function addCoordXY($x, $y): void
    {
        $this->savedSymbolList[$x . '_' . $y] = 1;
    }

    public function hasCoordXY($x, $y): bool
    {
        return isset($this->savedSymbolList[$x . '_' . $y]);
    }
}
