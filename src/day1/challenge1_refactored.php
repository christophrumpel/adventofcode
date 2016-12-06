<?php

$x = 0;
$y = 0;
$heading = 'U';
$directions = 'URDL';

$input = [
    "R3", "R1", "R4", "L4", "R3", "R1", "R1", "L3", "L5", "L5", "L3", "R1", "R4", "L2", "L1", "R3", "L3", "R2", "R1", "R1", "L5", "L2", "L1", "R2", "L4", "R1", "L2", "L4", "R2", "R2", "L2", "L4", "L3", "R1", "R4", "R3", "L1", "R1", "L5", "R4", "L2", "R185", "L2", "R4", "R49", "L3", "L4", "R5", "R1", "R1", "L1", "L1", "R2", "L1", "L4", "R4", "R5", "R4", "L3", "L5", "R1", "R71", "L1", "R1", "R186", "L5", "L2", "R5", "R4", "R1", "L5", "L2", "R3", "R2", "R5", "R5", "R4", "R1", "R4", "R2", "L1", "R4", "L1", "L4", "L5", "L4", "R4", "R5", "R1", "L2", "L4", "L1", "L5", "L3", "L5", "R2", "L5", "R4", "L4", "R3", "R3", "R1", "R4", "L1", "L2", "R2", "L1", "R4", "R2", "R2", "R5", "R2", "R5", "L1", "R1", "L4", "R5", "R4", "R2", "R4", "L5", "R3", "R2", "R5", "R3", "L3", "L5", "L4", "L3", "L2", "L2", "R3", "R2", "L1", "L1", "L5", "R1", "L3", "R3", "R4", "R5", "L3", "L5", "R1", "L3", "L5", "L5", "L2", "R1", "L3", "L1", "L3", "R4", "L1", "R3", "L2", "L2", "R3", "R3", "R4", "R4", "R1", "L4", "R1", "L5"
];


foreach($input as $command) {
    $turn = substr($command, 0, 1); // R
    $steps = substr($command, 1); // 3
    $index = strpos($directions, $heading); // 0
    if ($turn == 'R') {
        $index++; // 1
    } elseif($turn == 'L') {
        $index--;
    }
    $index %= 4; //0
    $heading = substr($directions, $index, 1); // R
    switch($heading) {
        case 'U':
            $y += $steps;
            break;
        case 'R':
            $x += $steps;
            break;
        case 'D':
            $y -= $steps;
            break;
        case 'L':
            $x -= $steps;
            break;
    }
}
var_dump(abs($x) + abs($y));