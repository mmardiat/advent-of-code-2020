<?php

require "vendor/autoload.php";

use Classes\Utils;

$inputs = Utils::getInput($argc, $argv);

$groupAnswers = [];
$groupAnswersAsString = [];
$groupKey = 0;
foreach ($inputs as $answers) {
    if ($answers === '') {
        ++$groupKey;
        continue;
    }

    $groupAnswersAsString[$groupKey][] = $answers;
    $answers = str_split($answers);
    foreach ($answers as $answer) {
        $groupAnswers[$groupKey][] = $answer;
    }
}

$questionsAnswered = 0;
foreach ($groupAnswers as $answers) {
    $questionsAnswered += count(array_unique($answers));
}

$allAnsweredCount = 0;
foreach ($groupAnswersAsString as $groupAnswer) {
    $participantCount = count($groupAnswer);
    $answerCount = [];
    foreach ($groupAnswer as $answer) {
        $answers = str_split($answer);
        foreach ($answers as $v) {
            if (isset($answerCount[$v])) {
                ++$answerCount[$v];
            } else {
                $answerCount[$v] = 1;
            }
        }
    }

    foreach ($answerCount as $count) {
        if ($count === $participantCount) {
            ++$allAnsweredCount;
        }
    }
}

// First part
echo $questionsAnswered . PHP_EOL;
// Second part
echo $allAnsweredCount . PHP_EOL;
