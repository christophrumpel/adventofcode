<?php
/**
 * Created by PhpStorm.
 * User: christophrumpel
 * Date: 08/12/2016
 * Time: 18:01
 */

namespace App;


class RoomEncrypter
{

    public function isRoomReal($room)
    {
        // Separate string parts
        $sum = substr($room, -6, 5);
        $charactersAndId = substr($room, 0, -7);
        $sectorId = substr($charactersAndId, -3);
        $characters = substr($charactersAndId, 0, -4);

        // Check count of strings
        $characters = str_replace('-', '', $characters);
        $characters = str_split($characters);
        $counts = array_count_values($characters);

        foreach ($counts as $key => &$count) {
            $count = ["character" => $key, "count" => $count];
        }

        usort($counts, function ($a, $b) {
            if ($a["count"] == $b["count"]) {
                return strcasecmp($a["character"], $b["character"]);
            }

            return $b['count'] - $a['count'];
        });

        $checksum = implode(array_column($counts, 'character'));

        return strpos($checksum, $sum) !== false;
    }

    public function getSumOfRealRooms($input)
    {
        $sum = 0;
        $roomCodes = explode("\n", $input);
        $roomCodes = array_map(function ($code) {
            return trim($code);
        }, $roomCodes);

        foreach ($roomCodes as $roomCode) {
            $sectorId = substr($roomCode, -10, 3);

            if ($this->isRoomReal($roomCode)) {
                $sum += $sectorId;
            }
        }

        return $sum;
    }

    public function decodeRoomName($roomName)
    {
        $id = substr($roomName, -10, 3);

        // Get characters from code
        $words = explode("-", substr($roomName, 0, -11));

        for ($i = 0; $i < $id; $i++) {
            foreach ($words as $key => &$word) {
                $word = $this->increaseEachCharacter($word);
            }
        }

        return implode(" ", $words) . '(' . $id . ')';
    }

    private function increaseEachCharacter($word)
    {
        $characters = str_split($word);

        foreach ($characters as &$character) {
            if ($character == "z") {
                $character = "a";
            } else {
                $character++;
            }
        }

        return implode($characters);
    }
}