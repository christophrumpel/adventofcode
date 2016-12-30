<?php


use App\BotController;
use PHPUnit\Framework\TestCase;

class BotControllerTest extends TestCase
{

    /**
     * @test
     */
    public function it_tells_what_bot_is_responsible_for_comparing_two_chips()
    {
        $input = "value 5 goes to bot 2
bot 2 gives low to bot 1 and high to bot 0
value 3 goes to bot 1
bot 1 gives low to output 1 and high to bot 0
bot 0 gives low to output 2 and high to output 0
value 2 goes to bot 2";

        $botController = new BotController();

        $responsibleBot = $botController->loadInstructions($input)->getResponsibleBot(5,2);

        $this->assertEquals(2, $responsibleBot);
    }

    /**
     * @test
     */
    public function it_tells_what_bot_is_responsible_for_comparing_two_chips_with_whitespace()
    {
        $input = "value 5 goes to bot 2
        value 8 goes to bot 2
        bot 2 gives low to bot 1 and high to bot 0";

        $botController = new BotController();
        $responsibleBot = $botController->loadInstructions($input)->getResponsibleBot(5,8);

        $this->assertEquals(2, $responsibleBot);
    }

    /**
     * @test
     */
    public function it_tells_what_bot_is_responsible_for_comparing_two_chips_no_order()
    {
        $input = "value 5 goes to bot 2
        value 8 goes to bot 2
        bot 2 gives low to bot 1 and high to bot 0";

        $botController = new BotController();
        $responsibleBot = $botController->loadInstructions($input)->getResponsibleBot(8,5);

        $this->assertEquals(2, $responsibleBot);
    }

}