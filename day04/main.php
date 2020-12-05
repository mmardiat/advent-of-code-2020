<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

$passports = [];
$passportKey = 0;
foreach ($inputs as $input) {
    if ($input === "") {
        ++$passportKey;
        continue;
    }

    $inputFields = explode(' ', $input);

    foreach ($inputFields as $inputField) {
        list($key, $value) = explode(':', $inputField);
        $passports[$passportKey][$key] = $value;
    }
}

$validPassports = 0;
$validatedPassports = 0;
foreach ($passports as $passportFields) {
    $fieldCount = count($passportFields);
    if ($fieldCount === 8 || ($fieldCount === 7 && !array_key_exists('cid', $passportFields))) {
        ++$validPassports;

        if (validatePassport($passportFields)) {
            ++$validatedPassports;
        }
    }
}

// First part
echo 'Valid passport count is: ' . $validPassports . PHP_EOL;

// Second part
echo 'Validated passport count is: ' . $validatedPassports;

function validatePassport(array $passportFields)
{
    return rangeValidator($passportFields['byr'], 4, 1920, 2002) &&
        rangeValidator($passportFields['iyr'], 4, 2010, 2020) &&
        rangeValidator($passportFields['eyr'], 4, 2020, 2030) &&
        strlen($passportFields['pid']) === 9 &&
        validateHeight($passportFields['hgt']) &&
        in_array($passportFields['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']) &&
        preg_match('/^#[a-f0-9]{6}$/', $passportFields['hcl']);
}

function rangeValidator($value, int $nrOfDigits, int $minValue, int $maxValue)
{
    if (strlen($value) < $nrOfDigits) {
        return false;
    }

    if ((int) $value < $minValue || (int) $value > $maxValue) {
        return false;
    }

    return true;
}

function validateHeight(string $heightWithUnit)
{
    $unit = substr($heightWithUnit, -2);
    $height = str_replace($unit, '', $heightWithUnit);

    if (($unit === 'cm') && rangeValidator($height, 3, 150, 193)) {
        return true;
    }

    if (($unit === 'in') && rangeValidator($height, 2, 59, 76)) {
        return true;
    }

    return false;
}