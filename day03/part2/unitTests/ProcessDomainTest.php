<?php

declare(strict_types=1);


use App\Domain\ProcessDomain;
use PHPUnit\Framework\TestCase;


require_once(__DIR__ . '/../vendor/autoload.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_processLineListShouldFinishOk()
    {

        $lineList = [
            '467..114..',
            '...*......',
            '..35..633.',
            '......#...',
            '617*......',
            '.....+.58.',
            '..592.....',
            '......755.',
            '...$.*....',
            '.664.598..'
        ];

        $process = new ProcessDomain();
        $sum = $process->processLineList($lineList);

        $expectedSum = 467835;

        $this->assertEquals($expectedSum, $sum);
    }
}
