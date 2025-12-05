<?php

$input = [
    '3-5',
    '10-14',
    '16-20',
    '12-18',
    '',
    '1',
    '5',
    '8',
    '11',
    '17',
    '32',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$splitLocation = array_keys(array_filter($input, fn($value) => $value == ""))[0];

$ranges = array_slice($input, 0, $splitLocation);
$ids = array_slice($input, $splitLocation + 1);

$rangeStart = 0;
$rangeEnd = 0;
$freshIds = [];

foreach ($ranges as $range) {
    list($rangeStart, $rangeEnd) = sscanf($range, '%d-%d');

    foreach ($ids as $id) {
        if ($rangeStart <= $id && $id <= $rangeEnd) {
            echo "fresh ID found: $id\n";
            $freshIds[] = $id;
        }
    }
}

echo "found " . count(array_unique($freshIds)) . " unique ID's\n";

