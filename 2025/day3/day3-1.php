<?php

$input = [
    '987654321111111',
    '811111111111119',
    '234234234234278',
    '818181911112111',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$joltage = [];

foreach ($input as $bank) {
    $batteries = array_map(fn($battery): int => (int) $battery, str_split($bank, 1));

    $n1 = ['pos' => 0, 'num' => 0];
    for ($i = 0; $i < count($batteries) - 1; $i++) {
        if ($batteries[$i] > $n1['num']) {
            $n1['pos'] = $i;
            $n1['num'] = $batteries[$i];
        }
    }

    $n2 = ['pos' => 0, 'num' => 0];
    for ($i = $n1['pos'] + 1; $i < count($batteries); $i++) {
        if ($batteries[$i] > $n2['num']) {
            $n2['pos'] = $i;
            $n2['num'] = $batteries[$i];
        }
    }

    $joltage[] = ($n1['num'] * 10) + $n2['num'];
}

echo "sum of joltage: " . array_sum($joltage) . "\n";

