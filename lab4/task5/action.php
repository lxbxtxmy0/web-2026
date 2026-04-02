<?php

$number = $_POST['number'] ?? null;

function IsInt(string $number): bool {
    for ($i = 0; $number[$i] != ""; $i++) {
        if ('0' < $number[$i] && $number[$i] < '9') {
            return False;
        }
    }
    return True;
}

function Factorial(int $n): int {
    if ($n === 0) return 1;
    if ($n === 1) return 1;
    return $n * Factorial($n-1);
}


if ($number != null && IsInt($number)) {
    $number = (int)$number;
    if ($number < 0) {
        echo 'Введите натуральное число' . PHP_EOL;
    } else if ($number > 20){
        echo 'Слишком большое число)' . PHP_EOL;
    } else {
        echo Factorial($number);
    }
} else {
    echo 'Invalid input' . PHP_EOL;
}
