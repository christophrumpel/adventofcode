<?php

use App\TriangleChecker;
use PHPUnit\Framework\TestCase;

class TriangleCheckerTest extends TestCase
{

    /**
     * @test
     */
    public function it_detects_wrong_triangle()
    {

        $triangleChecker = new TriangleChecker();
        $correctTriangleCount = $triangleChecker->check("5  10  25");

        $this->assertEquals($correctTriangleCount, 0);

    }

    /**
     * @test
     */
    public function it_detects_valid_triangle()
    {

        $triangleChecker = new TriangleChecker();
        $correctTriangleCount = $triangleChecker->check("18  10  25");

        $this->assertEquals($correctTriangleCount, 1);

    }

    /**
     * @test
     */
    public function it_detects_valid_and_wrong_triangle()
    {
        $input = " 100  300  100
  200  400  300";
        $triangleChecker = new TriangleChecker();
        $correctTriangleCount = $triangleChecker->check($input);

        $this->assertEquals($correctTriangleCount, 1);

    }

    /**
     * @test
     */
    public function it_detects_valid_triangles_vertically()
    {
        $input = "245  771  269
                261  315  904
                669   96  581
                570  745  156
                124  678  684
                472  360   73";
        $triangleChecker = new TriangleChecker();
        $correctTriangleCount = $triangleChecker->checkVertically($input);

        $this->assertEquals($correctTriangleCount, 2);

    }

}
