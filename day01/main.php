<?php
require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

// First part
$inputKey = 0;
foreach ($inputs as $key => $value) {
    if (cycleValues($inputs, $inputKey)) {
        break;
    }

    ++$inputKey;
}

echo '----'  . PHP_EOL;

// Second part
$k = 0;
foreach ($inputs as $key => $value) {
    if (cycleValues($inputs, $k, true)) {
        break;
    }

    ++$k;
}

function cycleValues($inputs, $inputKey, $thirdOperator = false)
{
    foreach ($inputs as $key => $value) {
        if ($key === $inputKey) {
            continue;
        }

        $value = (int) trim($value);
        $value2 = (int) trim($inputs[$inputKey]);

        if ($thirdOperator) {
            foreach ($inputs as $k => $v) {
                if ($k === $inputKey || $k === $key) {
                    continue;
                }
                $value3 = (int) trim($v);

                if ($value + $value2 + $value3 === 2020) {
                    echo sprintf('Values are %d and %d and %d', $value, $value2, $value3) . PHP_EOL;
                    echo sprintf('Their multiplication is %d', $value * $value2 * $value3)  . PHP_EOL;

                    return true;
                }
            }
        } else if ($value + $value2 === 2020) {
            echo sprintf('Values are %d and %d', $value, $value2) . PHP_EOL;
            echo sprintf('Their multiplication is %d', $value * $value2) . PHP_EOL;

            return true;
        }
    }

    return false;
}