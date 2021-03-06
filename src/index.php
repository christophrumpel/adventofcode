<?php


use App\BotController;
use App\DisplayHandler;
use App\DoorPassword;
use App\FileCompressor;
use App\IpTester;
use App\MessageAnalyzer;
use App\PinCodeCalculator;
use App\RoomEncrypter;
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

// Day 4
$input = require "../src/Day4/input.php";
$roomEncrypter = new RoomEncrypter();
$sum = $roomEncrypter->getSumOfRealRooms($input);
prettyOutput("Sum of real rooms: " . $sum);
// Day 4 / 2
$roomCodes = explode("\n", $input);
$roomCodes = array_map(function ($code) {
    return trim($code);
}, $roomCodes);

//foreach ($roomCodes as $roomCode) {
//    prettyOutput($roomEncrypter->decodeRoomName($roomCode));
//}

// Day 5
//$doorPassword = new DoorPassword();
//$password = $doorPassword->generate("ojvtpuvg");
//prettyOutput("Door password: " . $password);
//
//$password = $doorPassword->generateComplexCode("ojvtpuvg");
//prettyOutput("Door password 2: " . $password);

// Day 6
$input = require "../src/Day6/input.php";
$messageAnalyzer = new MessageAnalyzer();
$message = $messageAnalyzer->analyze($input);
$message2 = $messageAnalyzer->analyze($input, "least");
prettyOutput("The message is: " . $message . " and with least common chars: " . $message2);

// Day 7
$input = require "../src/Day7/input.php";
$ipTester = new IpTester();
$validIps = $ipTester->howManyIpsSupport("Tsl", $input);
prettyOutput($validIps . " ips are TSL supported.");

$sslIps = $ipTester->howManyIpsSupport("Ssl", $input);
prettyOutput($sslIps . " ips are SSL supported.");

// Day 8
$input = require "../src/Day8/input.php";
$displayHandler = new DisplayHandler();
$displayHandler->setDisplay(50, 6)->load($input)->run();
prettyOutput($displayHandler->litPixelsCount() . ' pixels lit!');

var_dump($displayHandler->show());

// Day 9
$input = require "../src/Day9/input.php";
$fileCompressor = new FileCompressor();
$length = $fileCompressor->getInputLength($input);
prettyOutput('The length of the decompressed file is: ' . $length);

$length2 = $fileCompressor->getInputLength($input, true);
prettyOutput('The length of the decompressed (v2) file is: ' . $length2);

// Day 10
$input = require "../src/Day10/input.php";
$botController = new BotController();
$bot = $botController->loadInstructions($input)->getResponsibleBot(61, 17);
$multipliedOutputs = $botController->multiplyOutputs([0, 1, 2]);
prettyOutput('Bot number' . $bot . ' is responsible for the chips 61 and 17');
prettyOutput('If you multiply outpt values 0, 1 and 2 you get ' . $multipliedOutputs);
