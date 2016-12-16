<?php


namespace App;


class DisplayHandler
{

    protected $instructions;
    protected $display;

    /**
     * Setup display
     * @param int $length
     * @param int $height
     * @return $this
     */
    public function setDisplay(int $length, int $height)
    {
        $display = [];

        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $display[$i][$j] = 0;
            }
        }

        $this->display = $display;

        return $this;
    }

    /**
     * Visualize the current state of the display
     */
    public function show()
    {
        $output = "\n";
        foreach ($this->display as $row) {
            foreach ($row as $item) {
                $output .= $item == 0 ? "_ " : "# ";
            }

            $output .= "\n";
        }

        return $output;
    }

    public function load($instructions)
    {
        $this->instructions = explode("\n", $instructions);

        return $this;
    }

    public function run()
    {
        foreach ($this->instructions as $instruction) {
            switch ($instruction) {
                case strpos($instruction, 'rect') !== false:
                    $this->drawRect(substr($instruction, -3));
                    break;
                case strpos($instruction, 'rotate column') !== false:
//                    $this->rotateColumn
            }
        }

        return $this;
    }

    public function litPixelsCount()
    {
        $litPixels = 0;

        foreach ($this->display as $row) {
            foreach ($row as $item) {
                if ($item === 1) {
                    $litPixels++;
                }
            }
        }

        return $litPixels;
    }

    private function drawRect($size)
    {
        $length = substr($size, 0, 1);
        $height = substr($size, -1);

        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $this->display[$i][$j] = 1;
            }
        }
    }
}