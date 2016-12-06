<?php
use App\MessageAnalyzer;
use PHPUnit\Framework\TestCase;


class MessageAnalyzerTEst extends TestCase
{

    /**
     * @test
     */
    public function it_returns_the_correct_first_example_message()
    {

        $input = "eedadn
drvtee
eandsr
raavrd
atevrs
tsrnev
sdttsa
rasrtv
nssdts
ntnada
svetve
tesnvt
vntsnd
vrdear
dvrsen
enarar";

        $messageAnalyzer = new MessageAnalyzer();
        $message = $messageAnalyzer->analyze($input);

        $this->assertEquals($message, "easter");

        $message = $messageAnalyzer->analyze($input, "least");

        $this->assertEquals($message, "advent");

    }
}
