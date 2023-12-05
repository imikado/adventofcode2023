<?php

declare(strict_types=1);

use App\Domain\Entity\Game;
use PHPUnit\Framework\TestCase;


require_once(__DIR__ . '/../vendor/autoload.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_getScoreShouldFinishOk()
    {

        $game = new Game('Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53');

        $score = $game->getScore();

        $expectedScore = 8;


        $this->assertEquals($expectedScore, $score);
    }
}
