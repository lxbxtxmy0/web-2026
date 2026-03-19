<?php



$year = $_POST['year'];

if (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0)) {
    echo 'YES';
} else {
    echo 'NO';
}










