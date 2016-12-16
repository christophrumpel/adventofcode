<?php


use App\DisplayHandler;
use PHPUnit\Framework\TestCase;

class DisplayHandlerTest extends TestCase
{

    /**
     * @test
     */
    public function it_shows_the_current_display()
    {
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3);
        $output = "\n_ _ _ _ _ _ _ \n_ _ _ _ _ _ _ \n_ _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_creates_a_rect_on_the_display()
    {
        $instructions = "rect 3x2";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();

        $this->assertEquals(6, $display->litPixelsCount());

        $instructions = "rect 4x3";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();

        $this->assertEquals(12, $display->litPixelsCount());

        $instructions = "rect 1x1";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();

        $this->assertEquals(1, $display->litPixelsCount());

        $output = "\n# _ _ _ _ _ _ \n_ _ _ _ _ _ _ \n_ _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_creates_a_bigger_rectangle()
    {
        $instructions = "rect 34x1";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(50, 6)->load($instructions)->run();

        $this->assertEquals(1, $display->litPixelsCount());

        $this->assertEquals(34, $display->litPixelsCount());
    }
    
    /**
     * @test
     */
    public function it_can_rotate_column()
    {
        $instructions = "rect 3x2
        rotate column x=1 by 1";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n# _ # _ _ _ _ \n# # # _ _ _ _ \n_ # _ _ _ _ _ \n";
//        $this->assertEquals($output, $display->show());
    }
}