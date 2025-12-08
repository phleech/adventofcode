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

$rotations = explode("\n", trim(file_get_contents("input.txt")));

foreach ($rotations as $rotation) {
    list($direction, $step) = sscanf($rotation, '%1s%d');

    //first handle >100 step increments
    $zeroCrossed += (int) ($step / 100);
    $step %= 100;

    //then handle the balance
    $startPosition = $position;
    $position += ($direction == 'L' ? -$step : $step);

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

    if (
        ($startPosition != 0 && $direction == 'R' && $startPosition > $position) ||
        ($startPosition != 0 && $direction == 'L' && $startPosition < $position)
    ) {
        $zeroCrossed++;
    }
}

echo "zero landed: $zeroLanded, zero crossed: $zeroCrossed, total: " . $zeroLanded + $zeroCrossed. "\n";

