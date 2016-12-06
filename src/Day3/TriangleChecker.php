<?php

namespace App;


class TriangleChecker
{

    protected $validTriangleCount = 0;

    public function check($input)
    {
        $this->validTriangleCount = 0;
        $input = explode("\n", $input);

        foreach ($input as $triangle) {
            $triangle = $parts = preg_split('/\s+/', trim($triangle));

            $this->increaseCountIfValidTriangle($triangle);

        }

        return $this->validTriangleCount;
    }

    public function checkVertically($input)
    {
        $this->validTriangleCount = 0;
        $input = explode("\n", $input);
        $input = array_chunk($input, 3);

        foreach ($input as &$triangleGroup) {
            foreach ($triangleGroup as &$triangle) {
                $triangle = $parts = preg_split('/\s+/', trim($triangle));
            }
        }

        $inputSorted = [];

        foreach ($input as $tr) {
            $inputSorted[] = [$tr[0][0], $tr[1][0], $tr[2][0]];
            $inputSorted[] = [$tr[0][1], $tr[1][1], $tr[2][1]];
            $inputSorted[] = [$tr[0][2], $tr[1][2], $tr[2][2]];
        }



        foreach ($inputSorted as $triangle) {
            $this->increaseCountIfValidTriangle($triangle);
        }

        return $this->validTriangleCount;
    }

    /**
     * @param $triangle
     */
    protected function increaseCountIfValidTriangle($triangle)
    {
        if (($triangle[0] + $triangle[1] > $triangle[2]) && ($triangle[1] + $triangle[2] > $triangle[0]) && ($triangle[2] + $triangle[0] > $triangle[1])) {
            $this->validTriangleCount++;

        }
    }
}