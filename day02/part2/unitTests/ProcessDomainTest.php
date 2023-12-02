<?php

declare(strict_types=1);

use App\Domain\Entity\Game;
use PHPUnit\Framework\TestCase;


require_once(__DIR__ . '/../vendor/autoload.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_getMinimumNumberByCubeColorShouldFinishOk()
    {

        $game = new Game('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertEquals(1, $game->id);

        $minimumBlue = $game->getMinimumNumberByCubeColor(Game::COLOR_BLUE);
        $this->assertEquals(6, $minimumBlue);

        $minimumRed = $game->getMinimumNumberByCubeColor(Game::COLOR_RED);
        $this->assertEquals(4, $minimumRed);

        $minimumGreen = $game->getMinimumNumberByCubeColor(Game::COLOR_GREEN);
        $this->assertEquals(2, $minimumGreen);
    }
}
