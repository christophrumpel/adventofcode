<?php

namespace App;


class DoorPassword
{

    public function generate($doorId)
    {

        $index = 0;
        $password = "";

        for ($i = 0; $i < 8; $i++) {


            do {
                $index++;
                $hash = md5($doorId . $index);
            } while (strpos($hash, "00000") !== 0);

            $passwordCharacter = substr($hash, 5, 1);
            $password .= $passwordCharacter;
            $index++;
        }

        return $password;
    }

    public function generateComplexCode($doorId)
    {
        $index = 0;
        $password = "";
        $passwordCharacters = ["_", "_", "_", "_", "_", "_", "_", "_"];


        do {
            do {
                $index++;
                $hash = md5($doorId . $index);
            } while (strpos($hash, "00000") !== 0);

            $passwordPosition = substr($hash, 5, 1);
            $passwordCharacter = substr($hash, 6, 1);


            if (is_numeric($passwordPosition) && $passwordPosition < 8 && $passwordCharacters[$passwordPosition] == "_") {
                $passwordCharacters[$passwordPosition] = $passwordCharacter;
            }

            $index++;
        } while ((in_array("_", $passwordCharacters)));

        return implode($passwordCharacters);
    }
}