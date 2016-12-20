<?php


namespace App;

class FileCompressor
{

    public function getInputLength($string, $recursive = false)
    {
        $stringLength = strlen($string);
        $length = $stringLength;
        for ($i = 0; $i < $stringLength; $i++) {
            if ($string[$i] !== '(') {
                // If it is not a marker, continue
                continue;
            }

            // If it is a marker
            preg_match('/^\((\d+)x(\d+)\)/i', substr($string, $i), $matches);
            $matchLength = $matches[1];
            $times = $matches[2];
            $start = $i + strlen($matches[0]);
            $toRepeat = substr($string, $start, $matchLength);
            $decompressedLength = $recursive ? $this->getInputLength($toRepeat, true) : strlen($toRepeat);
            $length += ($decompressedLength * $times) - strlen($toRepeat) - strlen($matches[0]);
            $i = $start + strlen($toRepeat) - 1;
        }

        return $length;
    }
}