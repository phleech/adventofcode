<?php

$input = [
    '123 328  51 64 ',
    ' 45 64  387 23 ',
    '  6 98  215 314',
    '*   +   *   +',
];

$input = explode("\n", file_get_contents("input.txt"));

$d = [];

foreach ($input as $row) {
    $row = trim($row);
    $d[] = preg_split('/\s+/', $row);
}

$d[] = [];

for ($i = 0; $i < count($d[0]); $i++) {
    $num1 = $d[0][$i];
    $num2 = $d[1][$i];
    $num3 = $d[2][$i];
    $num4 = $d[3][$i];
    $op = $d[4][$i];

    switch ($op) {
        case '+':
            $d[5][$i] = $num1 + $num2 + $num3 + $num4;
            break;
        case '*':
            $d[5][$i] = $num1 * $num2 * $num3 * $num4;
            break;
    }
}

echo "total: " . array_sum($d[5]) . "\n";
