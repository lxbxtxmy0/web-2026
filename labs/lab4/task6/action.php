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
    for ($i = 0; $i < $length; $i++ ) {
        if (!(isDigit($expression[$i]) || isArithmeticOperation($expression[$i]) || $expression[$i] == ' ')) {
            return false;
        } else {
            if ($expression[$i] != ' ') {
                $symbols += 1;
            } else {
                $spaces += 1;
            }
        }
    }
    if ($symbols - $spaces != 1) {
        return false;
    }
    return true;
}

function split(string $expression): array {
    $arr = [];
    $len = 0;
    $length = myStrLen($expression);
    for ($i = 0; $i < $length; $i++) {
        if ($expression[$i] != ' ') {
            if (isArithmeticOperation($expression[$i])){
                $arr[] = $expression[$i];
            } else {
                $arr[] = (int)$expression[$i];
            }
            $len++;
        }
    }
    return [$arr, $len];
}

function polishNotationCalculation(array $arr): mixed {
    $stack = [];
    for ($i = 0; $i < $arr[1]; $i++) {
        if (isArithmeticOperation($arr[0][$i])){
            $secondDigit = array_pop($stack) ?? null;
            $firstDigit = array_pop($stack) ?? null;
            if ($firstDigit === null|| $secondDigit === null) {
                return false;
            }
            if ($arr[0][$i] == '+') {
                $stack[] = $firstDigit + $secondDigit;
            } else if ($arr[0][$i] == '-') {
                $stack[] = $firstDigit - $secondDigit;
            } else {
                $stack[] = $firstDigit * $secondDigit;
            }
        } else {
            $stack[] = $arr[0][$i];
        }
    }
    if (sizeof($stack) === 1) return $stack[0];
    return false;
}


if ($expression != null && isCorrectInput($expression)) {
    $result = polishNotationCalculation(split($expression));
    if ($result === false) {
        echo 'invalid input' . PHP_EOL;
    } else {
        echo $result . PHP_EOL;
    }
} else {
    echo 'Invalid input' . PHP_EOL;
}
