<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

// First part
$firstPartAnswer = findTrees(3, 1, $inputs);
echo 'First part answer, trees encountered: ' . findTrees(3, 1, $inputs) . PHP_EOL;

// Second part
$a = findTrees(1, 1, $inputs);
$b = findTrees(5, 1, $inputs);
$c = findTrees(7, 1, $inputs);
$d = findTrees(1, 2, $inputs);
$answersMultiplied = $a * $b * $c * $d * $firstPartAnswer;

echo 'Second part answer, trees encountered: ' . $answersMultiplied . PHP_EOL;

function findTrees(int $xStep, int $yStep, array $data) {
    $xAxis = $xStep;
    $yAxis = $yStep;
    $treeCount = 0;
    foreach ($data as $key => $mapRow) {
        if ($key !== $yAxis) {
            continue;
        }

        $mapRow = getCorrectLengthMapRow($mapRow, $xAxis);
        if ($mapRow[$xAxis] === '#') {
            ++$treeCount;
        }

        $xAxis += $xStep;
        $yAxis += $yStep;
    }

    return $treeCount;
}


function getCorrectLengthMapRow($mapRow, $xAxis)
{
    return str_repeat($mapRow, ceil($xAxis / (strlen($mapRow) - 1)));
}
