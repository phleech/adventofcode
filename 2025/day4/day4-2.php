<?php

$input = [
    '..@@.@@@@.',
    '@@@.@.@.@@',
    '@@@@@.@.@@',
    '@.@@@@..@.',
    '@@.@@@@.@@',
    '.@@@@@@@.@',
    '.@.@.@.@@@',
    '@.@@@.@@@@',
    '.@@@@@@@@.',
    '@.@.@@@.@.',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$grid = array_map(fn($row): array => str_split($row, 1), $input);
$total = 0;

do {
    $iterationTotal = 0;

    for ($rowId = 0; $rowId < count($grid); $rowId++) {
        for ($colId = 0; $colId < count($grid[$rowId]); $colId++) {
            $curCell = $grid[$rowId][$colId];
            //echo "curCel: $curCell, ";

            if (!in_array($curCell, ['@', 'x'])) { continue; }

            $rollNeighbor = 0;

            $onTopRow = $rowId == 0;
            $onBottomRow = $rowId == count($grid) - 1;
            $onLeftCol = $colId == 0;
            $onRightCol = $colId == count($grid[$rowId]) - 1;

            if (!$onTopRow) {
                if (in_array($grid[$rowId - 1][$colId], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onBottomRow) {
                if (in_array($grid[$rowId + 1][$colId], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onLeftCol) {
                if (in_array($grid[$rowId][$colId - 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onRightCol) {
                if (in_array($grid[$rowId][$colId + 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onTopRow && !$onLeftCol) {
                if (in_array($grid[$rowId - 1][$colId - 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onBottomRow && !$onLeftCol) {
                if (in_array($grid[$rowId + 1][$colId - 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onTopRow && !$onRightCol) {
                if (in_array($grid[$rowId - 1][$colId + 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            if (!$onBottomRow && !$onRightCol) {
                if (in_array($grid[$rowId + 1][$colId + 1], ['@', 'x'])) {
                    $rollNeighbor++;
                }
            }

            //echo "rowId: $rowId, colId: $colId, rollNeight: $rollNeighbor\n";

            if ($rollNeighbor < 4) {
                $iterationTotal++;
                $grid[$rowId][$colId] = 'x';
            }
        }
    }

    for ($rowId = 0; $rowId < count($grid); $rowId++) {
        for ($colId = 0; $colId < count($grid[$rowId]); $colId++) {
            if ($grid[$rowId][$colId] == 'x') {
                $grid[$rowId][$colId] = '.';
            }
        }
    }

    $total += $iterationTotal;

    echo "iterationTotal: $iterationTotal\n";

} while ($iterationTotal > 0);

echo "total number of rolls: $total\n";
