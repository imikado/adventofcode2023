<?php

declare(strict_types=1);

use App\Domain\Entity\Game;
use PHPUnit\Framework\TestCase;


require_once(__DIR__ . '/../vendor/autoload.php');

final class ProcessDomainTest  extends TestCase
{
    public function test_newGameShouldFinishOk()
    {

        $game = new Game('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green');

        $this->assertEquals(1, $game->id);

        $iteration1 = $game->getIteration(0);
        $this->assertEquals(3, $iteration1->getNumberOfCubeColor('blue'));
        $this->assertEquals(4, $iteration1->getNumberOfCubeColor('red'));

        $iteration2 = $game->getIteration(1);
        $this->assertEquals(1, $iteration2->getNumberOfCubeColor('red'));
        $this->assertEquals(2, $iteration2->getNumberOfCubeColor('green'));
        $this->assertEquals(6, $iteration2->getNumberOfCubeColor('blue'));

        $iteration3 = $game->getIteration(2);
        $this->assertEquals(2, $iteration3->getNumberOfCubeColor('green'));
    }

    public function test_canPlayWithNumberOfCubeColorShouldFinishOk()
    {
        $game = new Game('Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red');


        //12 red cubes, 13 green cubes, and 14 blue cubes

        $mandatoryBlue =   $game->canPlayWithNumberOfCubeColor(14, Game::COLOR_BLUE);
        $mandatoryRed =   $game->canPlayWithNumberOfCubeColor(12, Game::COLOR_RED);
        $mandatoryGreen =   $game->canPlayWithNumberOfCubeColor(13, Game::COLOR_GREEN);


        $this->assertEquals(false, $mandatoryBlue);
        $this->assertEquals(false, $mandatoryRed);
        $this->assertEquals(true, $mandatoryGreen);
    }
}
