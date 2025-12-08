<?php

$input = [
    '.......S.......',
    '...............',
    '.......^.......',
    '...............',
    '......^.^......',
    '...............',
    '.....^.^.^.....',
    '...............',
    '....^.^...^....',
    '...............',
    '...^.^...^.^...',
    '...............',
    '..^...^.....^..',
    '...............',
    '.^.^.^.^.^...^.',
    '...............',
];

$input = explode("\n", file_get_contents("input.txt"));

$grid = array_map(fn($row): array => str_split($row, 1), $input);
$splitCount = 0;

for ($r = 0; $r < count($grid); $r++) {
    $row = $grid[$r];

    for ($c = 0; $c < count($row); $c++) {
        $col = $row[$c];

        if ($col == '^') {
            $inLineOfBeam = false;

            for ($rc = $r - 1; $rc >= 0; $rc--) {
                $left = $grid[$rc][$c - 1];
                $above = $grid[$rc][$c];
                $right = $grid[$rc][$c + 1];

                //echo "left: $left, above: $above, right: $right\n";

                if ($above == '.') {
                    //continue;
                }

                if ($above == '^') {
                    $inLineOfBeam = false;
                    break;
                }

                if ($above == 'S') {
                    echo "hit\n";
                    $inLineOfBeam = true;
                    break;
                }

                if ($left == '^' || $right == '^') {
                    echo "hit\n";
                    $inLineOfBeam = true;
                    break;
                }
            }

            if ($inLineOfBeam) {
                //echo "split\n";
                $splitCount++;
            }

            echo "\n";
        }
    }
}

echo "total split: $splitCount\n";
