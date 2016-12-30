<?php


namespace App;


class BotController
{

    protected $chipMoves = [];
    protected $botRules = [];
    protected $bots = [];
    protected $botsHistory = [];
    protected $outputs = [];

    public function loadInstructions($input)
    {
        $instructions = explode("\n", $input);
        // only get the value instructions
        foreach ($instructions as $instruction) {
            $instruction = trim($instruction);
            if (substr($instruction, 0, 5) == 'value') {
                $this->chipMoves[] = $instruction;
            } else {
                preg_match('/\d+/', $instruction, $botNumber);
                $this->botRules[$botNumber[0]] = $instruction;
            }
        }

        return $this;
    }

    public function getResponsibleBot($chip1, $chip2)
    {
        // Get ove instructions
        foreach ($this->chipMoves as $chipMove) {

            // Move the chip
            $this->moveChip($chipMove);
        }

        foreach ($this->botsHistory as $key => $bot) {
            if ($bot == [$chip1, $chip2] || $bot == [$chip2, $chip1]) {
                return $key;
            }
        }

        echo '<pre>';
        print_r($this->botsHistory);

        return false;
        echo '</pre>';


    }

    private function moveChip($moveInstruction)
    {
        // Get bot and chip digit Make move of the chip "value 5 goes to bot 2"
        preg_match_all('/\d+/', $moveInstruction, $matches);
        $chip = $matches[0][0];
        $botNumber = $matches[0][1];

        $this->bots[$botNumber][] = $chip;

        // If bot has two chips now
        if (count($this->bots[$botNumber]) > 1) {
            // Store which chips the bot had, for late comparision
            $this->botsHistory[$botNumber] = $this->bots[$botNumber];
            // and distribute chips like defined by the rules
            $this->botDistributesChips($botNumber);

        }
    }

    private function botDistributesChips($botNumber)
    {
        $rule = $this->botRules[$botNumber];
        preg_match_all('/(bot|output)/', $rule, $destinations);
        preg_match_all('/\d+/', $rule, $digits);

        // Values to distribute
        $lowValueChip = min($this->bots[$botNumber]);
        $highValueChip = max($this->bots[$botNumber]);

        $destinationLowerType = $destinations[0][1];
        $destinationLowerNumber = $digits[0][1];
        $destinationHigherType = $destinations[0][2];
        $destinationHigherNumber = $digits[0][2];

        // Move lower chip to bot or output
        $this->{$destinationLowerType . "s"}[$destinationLowerNumber][] = $lowValueChip;
        $this->{$destinationHigherType . "s"}[$destinationHigherNumber][] = $highValueChip;

        // Reset bot
        $this->bots[$botNumber] = [];

        // Check if a new bot has two chips to distribute
        if ($destinationLowerType == 'bot' && count($this->bots[$destinationLowerNumber]) > 1) {
            $this->botsHistory[$destinationLowerNumber] = $this->bots[$destinationLowerNumber];
            $this->botDistributesChips($destinationLowerNumber);
        }

        if ($destinationHigherType == 'bot' && count($this->bots[$destinationHigherNumber]) > 1) {
            $this->botsHistory[$destinationHigherNumber] = $this->bots[$destinationHigherNumber];
            $this->botDistributesChips($destinationHigherNumber);
        }
    }

    public function multiplyOutputs(array $outputs)
    {
        $count = 1;

        foreach ($outputs as $output) {
            var_dump($this->outputs[$output]);
                $count *= array_product($this->outputs[$output]);
        }

        return $count;
    }

}