<?php


$digit = $_POST['digit'];

function DigitToWord(string $digit): string {
    $word = match($digit) {
        '1' => 'Один',
        '2' => 'Два',
        '3' => 'Три',
        '4' => 'Четыре',
        '5' => 'Пять',
        '6' => 'Шесть',
        '7' => 'Семь',
        '8' => 'Восемь',
        '9' => 'Девять',
        '0' => 'Ноль',
        default => '0'
    };
    return $word;
}

$word = DigitToWord($digit);

if ($word === '0') {
    echo 'Вы ввели не число';
} else {
    echo $word;
}
