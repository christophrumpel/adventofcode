<?php


use App\MessageAnalyzer;
use App\PinCodeCalculator;
use App\TriangleChecker;

require '../vendor/autoload.php';
require '../src/helper.php';


// Day 2
$input = require "../src/Day2/input.php";
$pinCodeCalculator = new PinCodeCalculator();
$pin = $pinCodeCalculator->calculatePin($input);
prettyOutput("The first code is: " . $pin);

$pin2 = $pinCodeCalculator->calculatePin($input, "keypad2");
prettyOutput("The second code is: " . $pin2);

// Day 3
$input = require "../src/Day3/input.php";
$triangleChecker = new TriangleChecker();
$count = $triangleChecker->check($input);
prettyOutput("Number of valid triangles: " . $count);
//
$count2 = $triangleChecker->checkVertically($input);
prettyOutput("Number of vertical valid triangles: " . $count2);

// Day 6
$input = require "../src/Day6/input.php";
$messageAnalyzer = new MessageAnalyzer();
$message = $messageAnalyzer->analyze($input);
$message2 = $messageAnalyzer->analyze($input, "least");
prettyOutput("The message is: " . $message . " and with least common chars: " . $message2);


