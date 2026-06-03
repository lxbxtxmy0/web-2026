<?php

$expression = $_POST['expression'] ?? null;

function isDigit(string $char): bool {
    return ('0' <= $char && $char <= '9');
}

function isArithmeticOperation(string $char): bool {
    return ($char === '+' || $char === '-' || $char === '*');
}

function myStrLen(string $expression): int {
    $len = 0;
    while (isset($expression[$len])) {
        $len++;
    }
    return $len;
}

function isCorrectInput(string $expression): bool {
    $symbols = 0;
    $spaces = 0;
    $length = myStrLen($expression);

    for ($i = 0; $i < $length; $i++) {
        if (!(isDigit($expression[$i]) || isArithmeticOperation($expression[$i]) || $expression[$i] === ' ')) {
            return false;
        } else {
            if ($expression[$i] !== ' ') {
                $symbols += 1;
            } else {
                $spaces += 1;
            }
        }
    }

    if ($symbols - $spaces !== 1) {
        return false;
    }
    return true;
}

function splitExpression(string $expression): array {
    $arr = [];
    $len = 0;
    $length = myStrLen($expression);

    for ($i = 0; $i < $length; $i++) {
        if ($expression[$i] !== ' ') {
            if (isArithmeticOperation($expression[$i])){
                $arr[$len] = $expression[$i];
            } else {
                $arr[$len] = (int)$expression[$i];
            }
            $len++;
        }
    }
    return [$arr, $len];
}

function polishNotationCalculation(array $arr): mixed {
    $stack = [];
    $stackSize = 0;

    $arrayElements = $arr[0];
    $arrayLength = $arr[1];

    for ($i = 0; $i < $arrayLength; $i++) {
        if (isArithmeticOperation($arrayElements[$i])) {
            if ($stackSize < 2) return false;

            $secondDigit = $stack[$stackSize - 1];
            $firstDigit = $stack[$stackSize - 2];
            $stackSize -= 2;

            if ($arrayElements[$i] === '+') {
                $stack[$stackSize] = $firstDigit + $secondDigit;
            } else if ($arrayElements[$i] === '-') {
                $stack[$stackSize] = $firstDigit - $secondDigit;
            } else {
                $stack[$stackSize] = $firstDigit * $secondDigit;
            }
            $stackSize++;

        } else {
            $stack[$stackSize] = $arrayElements[$i];
            $stackSize++;
        }
    }

    if ($stackSize === 1) {
        return $stack[0];
    }

    return false;
}

if ($expression !== null) {
    if (isCorrectInput($expression)) {
        $result = polishNotationCalculation(splitExpression($expression));
        if ($result === false) {
            echo 'Invalid input' . PHP_EOL;
        } else {
            echo $result . PHP_EOL;
        }
    } else {
        echo 'Invalid input' . PHP_EOL;
    }
}