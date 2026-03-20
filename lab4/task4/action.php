<?php

const UPPER_BOUND = 999999;
const LOWER_BOUND = 100000;

$rightEdge = (int)$_POST['right_edge'];
$leftEdge = (int)$_POST['left_edge'];

function IsLuckyTicket($number): bool {
    $number = (string)$number;
    $leftSum = 0;
    $rightSum = 0;
    for ($i = 0; $i < 6; $i++) {
        $digit = (int)$number[$i];
        if ($i <= 2) {
            $leftSum += $digit;
        } else {
            $rightSum += $digit;
        }
    }
    if ($leftSum == $rightSum) {
        return True;
    }
    return False;
}


if (($leftEdge > $rightEdge) || ($leftEdge + $rightEdge < LOWER_BOUND * 2) || ($leftEdge + $rightEdge > UPPER_BOUND * 2)){
    echo 'Неверно задан диапозон';
} else {
    for ($i = $leftEdge; $i <= $rightEdge; $i++) {
        if (IsLuckyTicket($i)) {
            echo $i . PHP_EOL;
        }
    }
}