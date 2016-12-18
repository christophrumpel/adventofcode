<?php


namespace App;


use Exception;

class DisplayHandler
{

    protected $instructions;
    protected $display;
    protected $displayLength;
    protected $displayHeight;

    /**
     * Setup display
     * @param int $length
     * @param int $height
     * @return $this
     */
    public function setDisplay(int $length, int $height)
    {
        $display = [];
        $this->displayLength = $length;
        $this->displayHeight = $height;

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
            if (strpos($instruction, 'rect') !== false) {
                $this->drawRect(substr($instruction, -4));
            } elseif (strpos($instruction, 'rotate column') !== false) {
                $this->rotateColumn($instruction);
            } elseif (strpos($instruction, 'rotate row') !== false) {
                $this->rotateRow($instruction);
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
        $length = substr($size, 0, 2);
        $height = substr($size, -1);

        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $this->display[$i][$j] = 1;
            }
        }
    }

    private function rotateColumn($instruction)
    {

        list($column, $count) = $this->getInstructionNumbers($instruction);

        for ($c = 0; $c < $count; $c++) {
            $lastDisplayValue = $this->display[$this->displayHeight - 1][$column];

            for ($i = 0; $i < $this->displayHeight; $i++) {
                $nextLastDisplayValue = $this->display[$i][$column];
                $this->display[$i][$column] = $lastDisplayValue;
                $lastDisplayValue = $nextLastDisplayValue;
            }
        }
    }

    private function rotateRow($instruction)
    {
        list($row, $count) = $this->getInstructionNumbers($instruction);

        for ($c = 0; $c < $count; $c++) {
            $lastDisplayValue = end($this->display[$row]);

            for ($i = 0; $i < $this->displayLength; $i++) {
                $nextLastDisplayValue = $this->display[$row][$i];
                $this->display[$row][$i] = $lastDisplayValue;
                $lastDisplayValue = $nextLastDisplayValue;
            }
        }
    }

    private function getInstructionNumbers(String $instruction)
    {
        // Get column and value
        $numbers = preg_match_all('/(\d+)/', $instruction, $matches);

        if (!$numbers) {
            throw new Exception('Wrong instruction: ' . $instruction);
        }

        return [
            $matches[0][0],
            $matches[0][1],
        ];
    }
}