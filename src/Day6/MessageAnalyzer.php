<?php
namespace App;


class MessageAnalyzer
{

    protected $encodedMessage = "";
    protected $messageValuesByRow = [];
    protected $messageLength;
    protected $method;


    public function analyze($input, $method = "most")
    {
        $this->resets();
        $this->method = $method;

        $input = explode("\n", $input);

        foreach ($input as $key => $message) {
            $this->messageLength = strlen($message);

            foreach (str_split($message) as $key => $character) {
                $this->messageValuesByRow[$key + 1][] = $character;
            }
        }

        for($i = 1; $i <= $this->messageLength; $i++) {
            $this->encodedMessage .= $this->getMostCommonValue($this->messageValuesByRow[$i]);
        }

        return $this->encodedMessage;


    }

    private function getMostCommonValue($array)
    {
        $c = array_count_values($array);
        $value = $this->method == "least" ? array_search(min($c), $c) : array_search(max($c), $c);

        return $value;
    }

    private function resets()
    {
        $this->encodedMessage = "";
        $this->messageLength = 0;
        $this->messageValuesByRow = [];
    }
}
