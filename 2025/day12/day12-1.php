<?php

$input = [
    '0:',
    '###',
    '##.',
    '##.',
    '',
    '1:',
    '###',
    '##.',
    '.##',
    '',
    '2:',
    '.##',
    '###',
    '##.',
    '',
    '3:',
    '##.',
    '###',
    '##.',
    '',
    '4:',
    '###',
    '#..',
    '###',
    '',
    '5:',
    '###',
    '.#.',
    '###',
    '',
    '4x4: 0 0 0 0 2 0',
    '12x5: 1 0 1 0 2 2',
    '12x5: 1 0 1 0 3 2',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$regions = [];
for ($i = 30; $i < count($input); $i++) {
    $matches = [];
    preg_match_all('/^(\w*):\s(.*+)$/', $input[$i], $matches);

    $regions[] = [
        'grid' => explode('x', $matches[1][0]),
        'quantity' => explode(' ', $matches[2][0]),
    ];
}

$fit = 0;

foreach ($regions as $region) {
    $size = $region['grid'][0] * $region['grid'][1];
    $quantity = array_sum($region['quantity']) * (3 * 3);

    if ($size >= $quantity) {
        $fit++;
    }
}

echo "valid regions: $fit\n";

