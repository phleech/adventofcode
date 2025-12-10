<?php

$input = [
    '[.##.] (3) (1,3) (2) (2,3) (0,2) (0,1) {3,5,4,7}',
    '[...#.] (0,2,3,4) (2,3) (0,4) (0,1,2) (1,2,3,4) {7,5,12,7,2}',
    '[.###.#] (0,1,2,3,4) (0,3,4) (0,1,2,4,5) (1,2) {10,11,11,5,10,5}',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$instructions = array_map(function($instruction) {
    $indicatorDiagram = [];
    preg_match('/\\[(.*?)\\]/', $instruction, $indicatorDiagram);
    $indicatorDiagram = array_pop($indicatorDiagram);

    $buttonSchematics = [];
    preg_match_all('/\\((.*?)\\)/', $instruction, $buttonSchematics);
    $buttonSchematics = array_map(fn($schematic) => explode(',', $schematic), $buttonSchematics[1]);

    $numOfBulbs = strlen($indicatorDiagram);
    $bs = [];
    foreach ($buttonSchematics as $buttonIdx => $bulbs) {
        $t = 0;
        foreach ($bulbs as $bulbIdx) {
            $t = $t | (1 << ($numOfBulbs - 1) - $bulbIdx);
        }
        $bs[$buttonIdx] = $t;
    }

    return [
        'indicatorDiagram' => $indicatorDiagram,
        'buttonSchematics' => $buttonSchematics,
        'bs' => $bs,
    ];
}, $input);

$mins = [];

foreach ($instructions as $instruction) {
    //try every combination of pressing each button 0 and 1 times;
    //i.e 000000 => 111111 (63 cominations);
    
    $maxButtonCombinations = pow(2, count($instruction['buttonSchematics'])) - 1;
    $matches = [];

    for ($i = 1; $i <= $maxButtonCombinations; $i++) {
        $num = 0;

        foreach ($instruction['bs'] as $buttonIdx => $button) {
            if ($i & (1 << $buttonIdx)) {
                $num = $num ^ $button;
            }
        }

        if ($num == bindec(preg_replace(['/\./', '/#/'], ['0', '1'], $instruction['indicatorDiagram']))) {
            //represent the on/off states as a binary number
            $matches[] = $i;
        }
    }

    $min = 9999999999999999999999;
    foreach ($matches as $match) {
        $min = min($min, substr_count((string) decbin($match), '1'));
    }

    $mins[] = $min;
}

echo "sum: " . array_sum($mins) . "\n";

