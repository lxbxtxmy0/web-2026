<?php

$year = $_POST['year'] ?? null;

function isInt(string $number): bool {
    for ($i = 0; $number[$i] != ""; $i++) {
        if ('0' < $number[$i] && $number[$i] < '9') {
            return False;
        }
    }
    return True;
}

function isLeapYear(int $year): bool {
    return (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0));
}


if ($year != null && isInt($year)) {
    $year = (int)$year;
    if (isLeapYear($year) && $year >= 0 && $year <= 30000) {
        echo 'YES' . PHP_EOL;
    } else {
        echo 'NO' . PHP_EOL;
    }
} else {
    echo 'Invalid input' . PHP_EOL;
}


//проверка на то вводим число или нет - добавить

