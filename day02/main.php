<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

// First part
$validPasswords = 0;
foreach ($inputs as $input) {
    $dataPieces = explode(' ', $input);

    $range = explode('-', $dataPieces[0]);
    $rangeMin = (int) $range[0];
    $rangeMax = (int) $range[1];
    $requiredChar = str_replace(':', '', $dataPieces[1]);
    $password = $dataPieces[2];

    $charCountInPassword = substr_count($password, $requiredChar);

    if (($rangeMin <= $charCountInPassword) && ($charCountInPassword <= $rangeMax)) {
        ++$validPasswords;
    }
}

echo 'First part answer: ' . $validPasswords . PHP_EOL;

// Second part
$correctPasswords = 0;
foreach ($inputs as $input) {
    $input = trim($input);
    $dataPieces = explode(' ', $input);

    $positions = explode('-', $dataPieces[0]);
    $p1 = (int) $positions[0] - 1;
    $p2 = (int) $positions[1] - 1;
    $requiredChar = str_replace(':', '', $dataPieces[1]);
    $password = $dataPieces[2];

    if (($password[$p1] === $requiredChar && $password[$p2] !== $requiredChar) ||
        ($password[$p1] !== $requiredChar && $password[$p2] === $requiredChar)) {
        ++$correctPasswords;
    }
}

echo 'Second part answer: ' . $correctPasswords . PHP_EOL;