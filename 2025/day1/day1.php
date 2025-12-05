<?php

$position = 50;
$zeroLanded = 0;
$zeroCrossed = 0;

$rotations = [
    'L68',
    'L30',
    'R48',
    'L5',
    'R60',
    'L55',
    'L1',
    'L99',
    'R14',
    'L82',
];

$rotations = explode("\n", file_get_contents("input.txt"));

foreach ($rotations as $rotation) {
//    echo "current position = $position\n";

    list($direction, $step) = sscanf($rotation, '%1s%d');

    if ($direction == 'L') {
        $step *= -1;
    }

//    echo "this rotation = $rotation ($step)\n";

    //first handle >100 step increments
    $zeroCrossed += (int) (abs($step) / 100);
    $step %= 100;

    //then handle the balance
    $startPosition = $position;
    $position += $step;

    if ($position < 0) {
        $position += 100;
    }

    if ($position > 99) {
        $position -= 100;
    }

    if ($startPosition != 0 && $position == 0) {
        $zeroLanded++;
        continue;
    }

    if ($startPosition != 0 && $step > 0 && $startPosition > $position) {
        $zeroCrossed++;
        continue;
    }

    if ($startPosition != 0 && $step < 0 && $startPosition < $position) {
        $zeroCrossed++;
        continue;
    }
}

echo "zero landed = $zeroLanded, zero crossed = $zeroCrossed\n\n";

