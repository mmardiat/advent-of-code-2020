<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);



$groupAnswers = [];
$groupKey = 0;
foreach ($inputs as $answers) {
    if ($answers === '') {
        ++$groupKey;
        continue;
    }

    $answers = str_split($answers);
    foreach ($answers as $answer) {
        $groupAnswers[$groupKey][] = $answer;
    }
}

$questionsAnswered = 0;
$questionsAnsweredToAll = 0;
foreach ($groupAnswers as $answers) {
    $questionsAnswered += count(array_unique($answers));
}

// First part
echo $questionsAnswered . PHP_EOL;
// Second part
echo $questionsAnsweredToAll . PHP_EOL;
