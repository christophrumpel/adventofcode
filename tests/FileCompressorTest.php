<?php

use App\FileCompressor;
use PHPUnit\Framework\TestCase;

class FileCompressorTest extends TestCase
{

    //    /**
    //     * @test
    //     */
    //    public function it_decompresses_string_without_markers()
    //    {
    //        $fileCompressor = new FileCompressor();
    //        $file = "ADVENT";
    //        $this->assertEquals('ADVENT', $fileCompressor->decompress($file));
    //    }
    //
    //    /**
    //     * @test
    //     */
    //    public function it_decompresses_a_string_with_a_marker()
    //    {
    //        $fileCompressor = new FileCompressor();
    //        $file = "A(1x5)BC";
    //        $this->assertEquals('ABBBBBC', $fileCompressor->decompress($file));
    //    }
    //
    //    /**
    //     * @test
    //     */
    //    public function it_decompresses_a_longer_string_with_a_marker()
    //    {
    //        $fileCompressor = new FileCompressor();
    //        $file = "(3x3)XYZ";
    //        $this->assertEquals('XYZXYZXYZ', $fileCompressor->decompress($file));
    //    }
    //
    //    /**
    //     * @test
    //     */
    //    public function it_decompresses_a_string_with_two_markers()
    //    {
    //        $fileCompressor = new FileCompressor();
    //        $file = "A(2x2)BCD(2x2)EFG";
    //        $this->assertEquals('ABCBCDEFEFG', $fileCompressor->decompress($file));
    //    }
    //
    //    /**
    //     * @test
    //     */
    //    public function it_detects_when_a_marker_is_not_valid()
    //    {
    //        $fileCompressor = new FileCompressor();
    //        $file = "(6x1)(1x3)A";
    //        $this->assertEquals('(1x3)A', $fileCompressor->decompress($file));
    //    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_a_normal_string()
    {
        $fileCompressor = new FileCompressor();
        $file = "ADVENT";
        $this->assertEquals(6, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_a_string_with_marker()
    {
        $fileCompressor = new FileCompressor();
        $file = "A(1x5)BC";
        $this->assertEquals(7, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_a_string_with_multiple_chars_to_repeat()
    {
        $fileCompressor = new FileCompressor();
        $file = "(3x3)XYZ";
        $this->assertEquals(9, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_a_string_with_multiple_markers()
    {
        $fileCompressor = new FileCompressor();
        $file = "A(2x2)BCD(2x2)EFG";
        $this->assertEquals(11, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_a_string_with_wrong_marker()
    {
        $fileCompressor = new FileCompressor();
        $file = "(6x1)(1x3)A";
        $this->assertEquals(6, $fileCompressor->getInputLength($file));

        $fileCompressor = new FileCompressor();
        $file = "X(8x2)(3x3)ABCY";
        $this->assertEquals(18, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_doesnt_count_spaces_and_new_lines()
    {
        $fileCompressor = new FileCompressor();
        $file = "(6x1)(1x3)A";
        $this->assertEquals(6, $fileCompressor->getInputLength($file));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_string_with_one_marker_version2()
    {
        $fileCompressor = new FileCompressor();
        $file = "(3x3)XYZ";
        $this->assertEquals(9, $fileCompressor->getInputLength($file, true));

        $fileCompressor = new FileCompressor();
        $file = "(2x10)XYZ";
        $this->assertEquals(21, $fileCompressor->getInputLength($file, true));
    }

    /**
     * @test
     */
    public function it_tells_the_decompressed_length_of_string_with_multiple_marker_version2()
    {
        $fileCompressor = new FileCompressor();
        $file = "X(8x2)(3x3)ABCY";
        $this->assertEquals(20, $fileCompressor->getInputLength($file, true));

        $fileCompressor = new FileCompressor();
        $file = "(27x12)(20x12)(13x14)(7x10)(1x12)A";
        $this->assertEquals(241920, $fileCompressor->getInputLength($file, true));
    }

}