<?php

$startCoordinates = [0, 0];
$endCoordinates = [0, 0];
$lastDirection = [];
$visitedLocations = [];
$firstVisitedLocation = [];

$directions = [
    "R3", "R1", "R4", "L4", "R3", "R1", "R1", "L3", "L5", "L5", "L3", "R1", "R4", "L2", "L1", "R3", "L3", "R2", "R1", "R1", "L5", "L2", "L1", "R2", "L4", "R1", "L2", "L4", "R2", "R2", "L2", "L4", "L3", "R1", "R4", "R3", "L1", "R1", "L5", "R4", "L2", "R185", "L2", "R4", "R49", "L3", "L4", "R5", "R1", "R1", "L1", "L1", "R2", "L1", "L4", "R4", "R5", "R4", "L3", "L5", "R1", "R71", "L1", "R1", "R186", "L5", "L2", "R5", "R4", "R1", "L5", "L2", "R3", "R2", "R5", "R5", "R4", "R1", "R4", "R2", "L1", "R4", "L1", "L4", "L5", "L4", "R4", "R5", "R1", "L2", "L4", "L1", "L5", "L3", "L5", "R2", "L5", "R4", "L4", "R3", "R3", "R1", "R4", "L1", "L2", "R2", "L1", "R4", "R2", "R2", "R5", "R2", "R5", "L1", "R1", "L4", "R5", "R4", "R2", "R4", "L5", "R3", "R2", "R5", "R3", "L3", "L5", "L4", "L3", "L2", "L2", "R3", "R2", "L1", "L1", "L5", "R1", "L3", "R3", "R4", "R5", "L3", "L5", "R1", "L3", "L5", "L5", "L2", "R1", "L3", "L1", "L3", "R4", "L1", "R3", "L2", "L2", "R3", "R3", "R4", "R4", "R1", "L4", "R1", "L5"
];

$testDirections = ["R8", "R6", "R6", "R8"];

foreach ($directions as $direction) {
    $endCoordinates = updateCoordinates($lastDirection, $direction);
}

echo "RESULT: End coordinates [" . $endCoordinates[0] . ", " . $endCoordinates[1] . "] with a distance of: " . countBlocks($startCoordinates,
        $endCoordinates) . " first visited location: [" . $firstVisitedLocation[0][0] . ", " .
    $firstVisitedLocation[0][1] . "] distance to first vistt: " . countBlocks($startCoordinates, $firstVisitedLocation[0]);

function updateCoordinates($lastDirection, $direction)
{
    $count = substr($direction, 1);

    global $endCoordinates;

    if (empty($lastDirection)) {

        if (strpos($direction, 'L') !== false) {
            return subtractFromX($endCoordinates, $count);
        } elseif (strpos($direction, 'R') !== false) {
            return addToX($endCoordinates, $count);
        }

    } elseif ($lastDirection == ['+', 'x']) {

        if (strpos($direction, 'L') !== false) {
            return addToY($endCoordinates, $count);
        } elseif (strpos($direction, 'R') !== false) {
            return subtractFromY($endCoordinates, $count);
        }

    } elseif ($lastDirection == ['-', 'x']) {

        if (strpos($direction, 'L') !== false) {
            return subtractFromY($endCoordinates, $count);
        } elseif (strpos($direction, 'R') !== false) {
            return addToY($endCoordinates, $count);
        }

    } elseif ($lastDirection == ['+', 'y']) {

        if (strpos($direction, 'L') !== false) {
            return subtractFromX($endCoordinates, $count);
        } elseif (strpos($direction, 'R') !== false) {
            return addtoX($endCoordinates, $count);
        }

    } elseif ($lastDirection == ['-', 'y']) {

        if (strpos($direction, 'L') !== false) {
            return addToX($endCoordinates, $count);
        } elseif (strpos($direction, 'R') !== false) {
            return subtractFromX($endCoordinates, $count);
        }

    }
}

function addToX(&$coordinates, $count)
{
    global $lastDirection;
    global $visitedLocations;
    global $firstVisitedLocation;


    for ($i = 1; $i <= $count; $i++) {

        $newVisit = [$coordinates[0] + $i, $coordinates[1]];

        if (in_array($newVisit, $visitedLocations)) {
            var_dump('in array', $newVisit);
            $firstVisitedLocation[] = $newVisit;
        }
        $visitedLocations[] = $newVisit;

    }


    $coordinates[0] += $count;
    $lastDirection = ['+', 'x'];

    return $coordinates;
}

function addToY(&$coordinates, $count)
{
    global $lastDirection;
    global $visitedLocations;
    global $firstVisitedLocation;


    for ($i = 1; $i <= $count; $i++) {
        $newVisit = [$coordinates[0], $coordinates[1] + $i];

        if (in_array($newVisit, $visitedLocations)) {
            $firstVisitedLocation[] = $newVisit;
        }

        $visitedLocations[] = $newVisit;


    }

    $coordinates[1] += $count;
    $lastDirection = ['+', 'y'];

    return $coordinates;
}

function subtractFromX(&$coordinates, $count)
{
    global $lastDirection;
    global $visitedLocations;
    global $firstVisitedLocation;


    for ($i = 1; $i <= $count; $i++) {
        $newVisit = [$coordinates[0] - $i, $coordinates[1]];

        if (in_array($newVisit, $visitedLocations)) {
            $firstVisitedLocation[] = $newVisit;
        }
        $visitedLocations[] = $newVisit;

    }
    $coordinates[0] -= $count;
    $lastDirection = ['-', 'x'];

    return $coordinates;
}

function subtractFromY(&$coordinates, $count)
{
    global $lastDirection;
    global $visitedLocations;
    global $firstVisitedLocation;


    for ($i = 1; $i <= $count; $i++) {
        $newVisit = [$coordinates[0], $coordinates[1] - $i];

        if (in_array($newVisit, $visitedLocations)) {
            $firstVisitedLocation[] = $newVisit;
        }

        $visitedLocations[] = $newVisit;

    }
    $coordinates[1] -= $count;
    $lastDirection = ['-', 'y'];

    return $coordinates;
}

function countBlocks($startCoordinates, $endCoordinates)
{
    $x1 = $startCoordinates[0];
    $x2 = $endCoordinates[0];
    $y1 = $startCoordinates[1];
    $y2 = $endCoordinates[1];

    return abs($x2 - $x1) + abs($y2 - $y1);
}