<?php

$input = explode("\n", trim(file_get_contents("input.txt")));

$splitLocation = array_keys(array_filter($input, fn($value) => $value == ""))[0];
$ranges = array_slice($input, 0, $splitLocation);

$parsed = array_map(function($range) {
    list($start, $end) = sscanf($range, '%d-%d');

    return [
        's' => $start,
        'e' => $end,
    ];
}, $ranges);

usort($parsed, fn($a, $b) => $a['s'] > $b['s']);

$ranges = array_map(fn($item) => sprintf('%d-%d', $item['s'], $item['e']), $parsed);

for ($p = 0; $p < 100; $p++) {
    $workingRange = array_shift($ranges);
    $idsToPop = [];
    list($workingRangeStart, $workingRangeEnd) = sscanf($workingRange, '%d-%d');

    foreach ($ranges as $compareRangeId => $compareRange) {
        list($compareRangeStart, $compareRangeEnd) = sscanf($compareRange, '%d-%d');

        if ($compareRangeStart >= $workingRangeStart && $compareRangeStart <= $workingRangeEnd) {
            //         WWWWWW
            //         CCCC
            //          CCCC
            //            CCCCC
            //              CCCCC
            $workingRangeEnd = max($workingRangeEnd, $compareRangeEnd);
            $idsToPop[] = $compareRangeId;
            continue;
        }

        if ($compareRangeEnd >= $workingRangeStart && $compareRangeEnd <= $workingRangeEnd) {
            //         WWWWWW
            //           CCCC
            //          CCCC
            //       CCCCC
            //     CCCCC
            $workingRangeStart = min($workingRangeStart, $compareRangeStart);
            $idsToPop[] = $compareRangeId;
            continue;
        }

        if ($compareRangeStart <= $workingRangeStart && $compareRangeEnd >= $workingRangeEnd) {
            //         WWWWWWWW
            //         CCCCCCCC
            //      CCCCCCCCCCCCCC
            $workingRangeStart = min($workingRangeStart, $compareRangeStart);
            $workingRangeEnd = max($workingRangeEnd, $compareRangeEnd);
            $idsToPop[] = $compareRangeId;
            continue;
        }
    }

    foreach ($idsToPop as $idToPop) {
        unset($ranges[$idToPop]);
    }

    $ranges[] = sprintf('%d-%d', $workingRangeStart, $workingRangeEnd);
}

$foundCount = 0;

foreach ($ranges as $range) {
    list($start, $end) = sscanf($range, '%d-%d');

    $f = ($end - $start) + 1;
    $foundCount += $f;
}

echo "found $foundCount valid ID's\n";

