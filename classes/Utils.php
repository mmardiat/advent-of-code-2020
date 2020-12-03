<?php

namespace Classes;

use RuntimeException;

class Utils
{
    public static function getInput($argc, $argv): array
    {
        if ($argc && $argc > 1) {
            if (file_exists(realpath($argv[1]))) {
                $input = file(realpath($argv[1]), FILE_IGNORE_NEW_LINES);
                if (!$input) {
                    throw new RuntimeException('Failure upon file read!');
                }
            } else {
                throw new RuntimeException('Invalid input file: ' . $argv[1]);
            }
        } else {
            throw new RuntimeException('No input file!');
        }

        return $input;
    }
}