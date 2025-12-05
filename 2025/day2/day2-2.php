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
    echo "start: $rangeStart, end: $rangeEnd\n";

    for ($id = $rangeStart; $id <= $rangeEnd; $id++) {
        $len = strlen((string) $id);
        if ($len < 2) { continue; }

        for ($chunkLength = 1; $chunkLength < $len; $chunkLength++) {
            if ($len % $chunkLength != 0) {
                #is not cleanly devisable, so resulting left and
                #right would have different length
                continue;
            }

            $parts = str_split((string) $id, $chunkLength);

            if (count(array_count_values($parts)) === 1) {
                //all values match;
                echo "found invalid: $id\n";
                $invalidIds[] = $id;
            }
        }
    }

}

$invalidIds = array_unique($invalidIds);
//remove duplicates, e.g.:
//  2 2 2 2 2 2
//  22 22 22
//  222 222
//are all invalid in different ways, but are the same id

var_dump($invalidIds);

echo "sum of invalid id's: " . array_sum($invalidIds) . "\n";
