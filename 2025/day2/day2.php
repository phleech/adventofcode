<?php

$input = [
    '11-22',
    '95-115',
    '998-1012',
    '1188511880-1188511890',
    '222220-222224',
    '1698522-1698528',
    '446443-446449',
    '38593856-38593862',
    '565653-565659',
    '824824821-824824827',
    '2121212118-2121212124',
];

$input = explode(",", file_get_contents("input.txt"));

$invalidIds = [];

foreach ($input as $rangeString) {
    list($rangeStart, $rangeEnd) = sscanf($rangeString, '%d-%d');
//    echo "start: $rangeStart, end: $rangeEnd\n";

    for ($id = $rangeStart; $id <= $rangeEnd; $id++) {
//        echo "$id\n";

        $len = strlen((string) $id);

        if ($len % 2 != 0) {
            continue;
        }

        $len /= 2;

        $left = (int) ($id / pow(10, $len));
        $right = $id - ($left * pow(10, $len));

//        echo "left: $left, right: $right\n";

        if ($left == $right) {
//            echo "found invalid: $id\n";
            $invalidIds[] = $id;
        }
    }

}

//var_dump($invalidIds);

echo "sum of invalid id's: " . array_sum($invalidIds) . "\n";
