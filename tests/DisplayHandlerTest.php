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

        $this->assertEquals(34, $display->litPixelsCount());

        $instructions = "rect 12x2";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(50, 2)->load($instructions)->run();

        $this->assertEquals(24, $display->litPixelsCount());
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
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_can_rotate_column_multiple_times()
    {
        $instructions = "rect 3x2
        rotate column x=1 by 2";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n# # # _ _ _ _ \n# _ # _ _ _ _ \n_ # _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());

        $instructions = "rect 3x2
        rotate column x=1 by 3";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n# # # _ _ _ _ \n# # # _ _ _ _ \n_ _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());

        $instructions = "rect 3x2
        rotate column x=0 by 4";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n_ # # _ _ _ _ \n# # # _ _ _ _ \n# _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_can_rotate_a_row()
    {
        $instructions = "rect 3x2
        rotate row y=0 by 4";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n_ _ _ _ # # # \n# # # _ _ _ _ \n_ _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_can_rotate_a_row_multiple_rows()
    {
        $instructions = "rect 3x2
        rotate row y=0 by 4
        rotate row y=0 by 1";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n# _ _ _ _ # # \n# # # _ _ _ _ \n_ _ _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
    }

    /**
     * @test
     */
    public function it_can_rotate_a_column_and_row()
    {
        $instructions = "rect 3x2
        rotate column x=1 by 1
        rotate row y=0 by 4";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n_ _ _ _ # _ # \n# # # _ _ _ _ \n_ # _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
        $this->assertEquals(6, $displayHandler->litPixelsCount());

        $instructions = "rect 3x2
        rotate column x=1 by 1
        rotate row y=0 by 4
        rotate column x=1 by 1";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n_ # _ _ # _ # \n# _ # _ _ _ _ \n_ # _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
        $this->assertEquals(6, $displayHandler->litPixelsCount());
    }

    /**
     * @test
     */
    public function it_can_count_pixels_lit_with_multiple_rect_instructions()
    {
        $instructions = "rect 3x2
        rotate column x=1 by 1
        rotate row y=0 by 4
        rect 3x2";
        $displayHandler = new DisplayHandler();
        $display = $displayHandler->setDisplay(7, 3)->load($instructions)->run();
        $output = "\n# # # _ # _ # \n# # # _ _ _ _ \n_ # _ _ _ _ _ \n";
        $this->assertEquals($output, $display->show());
        $this->assertEquals(9, $displayHandler->litPixelsCount());

    }
}