<?php


$date = $_POST['date'] ?? null;

$dayMonthYear = [];

function isDigit(string $char): bool {
    return ('0' <= $char && $char <= '9');
}

function myStrLen(string $expression): int {
    $len = 0;
    while (isset($expression[$len])) {
        $len++;
    }
    return $len;
}
function isLeapYear(int $year): bool {
    return (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0));
}

function IsCorrectDate(string $date): bool {
    if (myStrLen($date) !== 10 || $date[2] !== '.' || $date[5] !== '.') {
        return false;
    }
    if (!IsDigit($date[3]) || !IsDigit($date[4])) {
        return false;
    }
    $month = (int)($date[3] . $date[4]);
    if ($month < 1 || $month > 12) {
        return false;
    }
    if (!IsDigit($date[6]) || !IsDigit($date[7]) || !IsDigit($date[8]) || !IsDigit($date[9])) {
        return false;
    }
    $year = (int)($date[6] . $date[7] . $date[8] . $date[9]);
    if ($year < 1) {
        return false;
    }
    $daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if (isLeapYear($year)) {
        $daysInMonths[1] = 29;
    }
    if (!IsDigit($date[0]) || !IsDigit($date[1])) {
        return false;
    }
    $day = (int)($date[0] . $date[1]);
    if ($day < 1 || $day > $daysInMonths[$month - 1]) {
        return false;
    }
    return true;
}
// упростить

function getZodiacSign(string $date): string {
    $parts[] = $date[0] . $date[1];
    $parts[] = $date[3] . $date[4];
    $day = (int)$parts[0];
    $month = (int)$parts[1];
    $zodiacs = [
        1  => ($day <= 19) ? "Козерог" : "Водолей",
        2  => ($day <= 18) ? "Водолей" : "Рыбы",
        3  => ($day <= 20) ? "Рыбы" : "Овен",
        4  => ($day <= 19) ? "Овен" : "Телец",
        5  => ($day <= 20) ? "Телец" : "Близнецы",
        6  => ($day <= 20) ? "Близнецы" : "Рак",
        7  => ($day <= 22) ? "Рак" : "Лев",
        8  => ($day <= 22) ? "Лев" : "Дева",
        9  => ($day <= 22) ? "Дева" : "Весы",
        10 => ($day <= 22) ? "Весы" : "Скорпион",
        11 => ($day <= 21) ? "Скорпион" : "Стрелец",
        12 => ($day <= 21) ? "Стрелец" : "Козерог"
    ];
    return $zodiacs[$month];
}

if ($date != null && isCorrectDate($date)) {
    echo getZodiacSign($date);
} else {
    echo 'invalid input' . PHP_EOL;
}

