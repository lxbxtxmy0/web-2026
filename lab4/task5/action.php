<?php




$number = (int)$_POST['number'];

function Factorial(int $n): int {
    if ($n === 0) return 1;
    if ($n === 1) return 1;
    return $n * Factorial($n-1);
}


if ($number < 0) {
    echo 'Введите натуральное число';
} else if ($number > 20){
    echo 'Слишком большое число)';
} else {
    echo Factorial($number);
}

