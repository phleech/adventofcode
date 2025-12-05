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

for ($rowId = 0; $rowId < count($grid); $rowId++) {
    for ($colId = 0; $colId < count($grid[$rowId]); $colId++) {
        $curCell = $grid[$rowId][$colId];

        if ($curCell != '@') { continue; }

        $neighbors = [];

        $onTopRow = $rowId == 0;
        $onBottomRow = $rowId == count($grid) - 1;
        $onLeftCol = $colId == 0;
        $onRightCol = $colId == count($grid[$rowId]) - 1;

        if (!$onTopRow) {
            $neighbors[] = $grid[$rowId - 1][$colId];
        }

        if (!$onBottomRow) {
            $neighbors[] = $grid[$rowId + 1][$colId];
        }

        if (!$onLeftCol) {
            $neighbors[] = $grid[$rowId][$colId - 1];
        }

        if (!$onRightCol) {
            $neighbors[] = $grid[$rowId][$colId + 1];
        }

        if (!$onTopRow && !$onLeftCol) {
            $neighbors[] = $grid[$rowId - 1][$colId - 1];
        }

        if (!$onBottomRow && !$onLeftCol) {
            $neighbors[] = $grid[$rowId + 1][$colId - 1];
        }

        if (!$onTopRow && !$onRightCol) {
            $neighbors[] = $grid[$rowId - 1][$colId + 1];
        }

        if (!$onBottomRow && !$onRightCol) {
            $neighbors[] = $grid[$rowId + 1][$colId + 1];
        }

        $paperNeighbors = array_filter($neighbors, fn($neighbor) => $neighbor == '@');

        if (count($paperNeighbors) < 4) {
            $total++;
        }
    }
}

echo "number of rolls: $total\n";
