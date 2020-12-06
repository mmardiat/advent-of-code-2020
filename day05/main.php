<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

$highestId = 0;
$seatIds = [];
foreach ($inputs as $boardingPass) {
    $firstPartOfPass = substr($boardingPass, 0, 7);
    $secondPartOfPass = substr($boardingPass, -3);

    $a = findRow(range(0, 127), $firstPartOfPass);
    $b = findRow(range(0, 7), $secondPartOfPass);
    $seatId = ($a * 8) + $b;
    $seatIds[] = $seatId;
    $highestId = $seatId > $highestId ? $seatId : $highestId;
}

// First part answer
echo $highestId . PHP_EOL;

sort($seatIds);
foreach ($seatIds as $key => $id) {
    if (isset($seatIds[$key - 1]) && ($seatIds[$key - 1] + 1) !== $id) {
        // Second part answer;
        echo $id - 1 . PHP_EOL;
    }
}


function findRow(array $seats, string $boardingPass)
{
    $instruction = $boardingPass[0];

    if (strlen($boardingPass) === 1) {
        if ($instruction === 'F' || $instruction === 'L') {
            return min($seats);
        }

        if ($instruction === 'B' || $instruction === 'R') {
            return max($seats);
        }
    }

    $length = count($seats);
    $lowerHalf = array_slice($seats, 0, $length / 2);
    $upperHalf = array_slice($seats, $length / 2);

    if ($instruction === 'F' || $instruction === 'L') {
        $seats = $lowerHalf;
    }

    if ($instruction === 'B' || $instruction === 'R') {
        $seats = $upperHalf;
    }

    $boardingPass = substr($boardingPass, 1);
    return findRow($seats, $boardingPass);
}

