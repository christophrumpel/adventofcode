<?php
use App\PinCodeCalculator;
use PHPUnit\Framework\TestCase;


class Challenge2Test extends TestCase
{

    /**
     * @test
     */
    public function it_returns_the_correct_first_example_pincode()
    {
        $instructions = "ULL
        RRDDD
        LURDL
        UUUUD";

        $pinCodeCalculator = new PinCodeCalculator();
        $pin = $pinCodeCalculator->calculatePin($instructions);
        $this->assertEquals($pin, "1985");
    }

    /**
     * @test
     */
    public function it_returns_the_correct_first_example_pincode_keypad2()
    {
        $instructions = "ULL
        RRDDD
        LURDL
        UUUUD";

        $pinCodeCalculator = new PinCodeCalculator();
        $pin = $pinCodeCalculator->calculatePin($instructions, "keypad2");
        $this->assertEquals($pin, "5DB3");
    }

    /**
     * @test
     */
    public function it_resets_the_pin()
    {
        $instructions = "ULL
        RRDDD
        LURDL
        UUUUD";

        $pinCodeCalculator = new PinCodeCalculator();
        $pin = $pinCodeCalculator->calculatePin($instructions, "keypad2");
        $this->assertEquals($pin, "5DB3");
        $pin = $pinCodeCalculator->calculatePin($instructions, "keypad2");
        $this->assertEquals($pin, "5DB3");
    }
}
