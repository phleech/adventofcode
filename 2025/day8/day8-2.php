<?php

$input = [
    '162,817,812',
    '57,618,57',
    '906,360,560',
    '592,479,940',
    '352,342,300',
    '466,668,158',
    '542,29,236',
    '431,825,988',
    '739,650,466',
    '52,470,668',
    '216,146,977',
    '819,987,18',
    '117,168,530',
    '805,96,715',
    '346,949,466',
    '970,615,88',
    '941,993,340',
    '862,61,35',
    '984,92,344',
    '425,690,689',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$junctionBoxes = array_map(fn($row) => preg_split('/,/', $row), $input);
$distances = [];

for ($i = 0; $i < count($junctionBoxes); $i++) {
    $distances[$i] = [];

    for ($d = 0; $d < count($junctionBoxes); $d++) {
        $distances[$i][$d] = sqrt(
            pow($junctionBoxes[$d][0] - $junctionBoxes[$i][0], 2) +
            pow($junctionBoxes[$d][1] - $junctionBoxes[$i][1], 2) +
            pow($junctionBoxes[$d][2] - $junctionBoxes[$i][2], 2)
        );
    }
}

$circuits = [];

for ($f = 0; $f < 10000; $f++) {
    $closestDistance = 99999999999999999999999;
    $q = $r = -1;

    foreach ($distances as $id1 => $j) {
        foreach ($j as $id2 => $distance) {
            if ($id1 == $id2) { continue; }

            if ($distance < $closestDistance) {
                $closestDistance = $distance;
                $q = $id1;
                $r = $id2;
            }
        }
    }

    checkAddGroup($q, $r, $circuits);

    unset($distances[$q][$r]);
    unset($distances[$r][$q]);

    $circuitsWithJunctionBoxes = array_filter($circuits);

    if (count($circuitsWithJunctionBoxes) == 1 && count(array_pop($circuitsWithJunctionBoxes)) == count($junctionBoxes)) {
        echo "Total: " . $junctionBoxes[$q][0] * $junctionBoxes[$r][0] . "\n";
        die();
    }
}

function checkAddGroup(int $junctionBox1Id, int $junctionBox2Id, array &$circuits): void {
    $existingCircuitIds = [];

    for ($i = 0; $i < count($circuits); $i++) {
        foreach ($circuits[$i] as $jb) {
            if (in_array($jb, [$junctionBox1Id, $junctionBox2Id])) {
                $existingCircuitIds[] = $i;
            }
        }
    }

    if (count($existingCircuitIds) == 0) {
        $circuits[] = [
            $junctionBox1Id => $junctionBox1Id,
            $junctionBox2Id => $junctionBox2Id,
        ];
    }

    if (count($existingCircuitIds) == 1) {
        $circuits[$existingCircuitIds[0]][$junctionBox1Id] = $junctionBox1Id;
        $circuits[$existingCircuitIds[0]][$junctionBox2Id] = $junctionBox2Id;
    }

    if (count($existingCircuitIds) == 2 && $existingCircuitIds[0] != $existingCircuitIds[1]) {
        $circuits[$existingCircuitIds[0]][$junctionBox1Id] = $junctionBox1Id;
        $circuits[$existingCircuitIds[0]][$junctionBox2Id] = $junctionBox2Id;

        foreach ($circuits[$existingCircuitIds[0]] as $jb) {
            $circuits[$existingCircuitIds[1]][$jb] = $jb;
        }
        $circuits[$existingCircuitIds[0]] = [];
    }
}
