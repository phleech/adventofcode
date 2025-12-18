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
$edges = [];
$maxArea = 0;

for ($i = 0; $i < count($input); $i++) {
    list($fX, $fY) = sscanf($input[$i], '%d,%d');
    list($tX, $tY) = sscanf($input[($i + 1) % count($input)], '%d,%d');

    $edges[] = ['x1' => $fX, 'y1' => $fY, 'x2' => $tX, 'y2' => $tY];
    $tiles[] = ['x' => $fX, 'y' => $fY];
}

for ($i = 0; $i < count($tiles) - 1; $i++) {
    for ($j = 0; $j < count($tiles); $j++) {
        $tile1 = $tiles[$i];
        $tile2 = $tiles[$j];

        $minX = min($tile1['x'], $tile2['x']);
        $minY = min($tile1['y'], $tile2['y']);

        $maxX = max($tile1['x'], $tile2['x']);
        $maxY = max($tile1['y'], $tile2['y']);

        if (!intersectsAnEdge($minX, $minY, $maxX, $maxY)) {
            $maxArea = max($maxArea, ($maxX - $minX + 1) * ($maxY - $minY + 1));
        }

    }
}

function intersectsAnEdge(int $minX, int $minY, int $maxX, int $maxY) : bool {
    global $edges;

    foreach ($edges as $edge) {
        $edgeMinX = min($edge['x1'], $edge['x2']);
        $edgeMaxX = max($edge['x1'], $edge['x2']);

        $edgeMinY = min($edge['y1'], $edge['y2']);
        $edgeMaxY = max($edge['y1'], $edge['y2']);

        if (
            $minX < $edgeMaxX && 
            $maxX > $edgeMinX && 
            $minY < $edgeMaxY && 
            $maxY > $edgeMinY
        ) {
            return true;
        }
    }

    return false;
}

echo "Max area: $maxArea\n";

