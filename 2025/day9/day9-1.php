<?php

$input = [
    '7,1',
    '11,1',
    '11,7',
    '9,7',
    '9,5',
    '2,5',
    '2,3',
    '7,3',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$tiles = [];

foreach ($input as $d) {
    list($col, $row) = sscanf($d, '%d,%d');
    $tiles[$row][$col] = $col;
}

$maxArea = 0;

foreach ($tiles as $aRow => $aCols) {
    foreach ($aCols as $aCol) {
        foreach ($tiles as $bRow => $bCols) {
            foreach ($bCols as $bCol) {
                if ($bCol == $aCol && $bRow == $aRow) { continue; }

                $deltaX = abs($bCol - $aCol) + 1;
                $deltaY = abs($bRow - $aRow) + 1;

                $area = $deltaX * $deltaY;

                if ($area > $maxArea) {
                    $maxArea = $area;
                }
            }
        }
    }
}

echo "max area: $maxArea\n";

