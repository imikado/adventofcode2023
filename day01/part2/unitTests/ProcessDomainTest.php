<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


require(__DIR__ . '/../domain/ProcessDomain.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_getNumberListByLineShouldFinishOk()
    {

        $domain = new ProcessDomain();
        $domain->enableDebug();

        $numberList = $domain->getNumberListByLine('doneight64qgc251four7');


        $expectedNumberList = ['one', 'eight', '6', '4', '2', '5', '1', 'four', '7'];
        $this->assertEquals(array_values($expectedNumberList), array_values($numberList), print_r($numberList, true));
    }

    /**
     * @dataProvider dataProvider_getNumberListByLineShouldFinishList
     */
    public function test_getNumberListByLineShouldFinishList($line, $expectedNumberList)
    {
        $domain = new ProcessDomain();
        $domain->enableDebug();

        $numberList = $domain->getNumberListByLine($line);

        $this->assertEquals(array_values($expectedNumberList), array_values($numberList), print_r($numberList, true));
    }
    public function dataProvider_getNumberListByLineShouldFinishList()
    {
        $dataList = [];

        $line = 'doneight64qgc251four7';
        $expectedList = ['one', 'eight', '6', '4', '2', '5', '1', 'four', '7'];
        $dataList[] = [$line, $expectedList];

        $line = '2nineninetwomlt';
        $expectedList = ['2', 'nine', 'nine', 'two'];
        $dataList[] = [$line, $expectedList];



        return $dataList;
    }
}
