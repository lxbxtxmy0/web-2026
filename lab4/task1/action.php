<?php



$year = (int)$_POST['year'];

if ((($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0)) && $year >= 0 && $year <= 30000) {
    echo 'YES';
} else {
    echo 'NO';
}










