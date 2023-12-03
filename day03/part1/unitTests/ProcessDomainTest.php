<?php

declare(strict_types=1);

use App\Domain\Entity\Number;
use App\Domain\Entity\Symbols;
use PHPUnit\Framework\TestCase;


require_once(__DIR__ . '/../vendor/autoload.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_numberHasAdjacentSymbolShouldFinishOk()
    {

        $number = new Number(1, 1);
        $number->add('2');
        $number->add('1');

        $symbols = new Symbols();
        $symbols->addCoordXY(0, 0);

        $hasAdjacent = $number->hasAdjacentSymbol($symbols);

        $this->assertEquals(true, $hasAdjacent);
    }

    /**
     * @dataProvider dataProvider_numberHasAdjacentSymbolShouldFinishList
     */
    public function test_numberHasAdjacentSymbolShouldFinishList($symbols, $expected)
    {
        $number = new Number(1, 1);
        $number->add('2');
        $number->add('1');

        $hasAdjacent = $number->hasAdjacentSymbol($symbols);

        $this->assertEquals($expected, $hasAdjacent);
    }
    public function dataProvider_numberHasAdjacentSymbolShouldFinishList()
    {
        $dataList = [];

        //--------
        $id = 'cornerTopLeft';
        $symbols = new Symbols();
        $symbols->addCoordXY(0, 0);
        $expected = true;

        $dataList[$id] = [$symbols, $expected];

        //--------
        $id = 'cornerBottomLeft';
        $symbols = new Symbols();
        $symbols->addCoordXY(0, 2);
        $expected = true;

        $dataList[$id] = [$symbols, $expected];

        //--------
        $id = 'cornerTopRight';
        $symbols = new Symbols();
        $symbols->addCoordXY(3, 0);
        $expected = true;

        $dataList[$id] = [$symbols, $expected];

        //--------
        $id = 'cornerBottomRight';
        $symbols = new Symbols();
        $symbols->addCoordXY(3, 2);
        $expected = true;

        $dataList[$id] = [$symbols, $expected];

        //--------
        $id = 'out';
        $symbols = new Symbols();
        $symbols->addCoordXY(4, 2);
        $expected = false;

        $dataList[$id] = [$symbols, $expected];



        return $dataList;
    }
}
