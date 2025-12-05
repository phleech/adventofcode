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
    for ($i = 0; $i < count($batteries) - 11; $i++) {
        if ($batteries[$i] > $n1['num']) {
            $n1['pos'] = $i;
            $n1['num'] = $batteries[$i];
        }
    }

    $n2 = ['pos' => 0, 'num' => 0];
    for ($i = $n1['pos'] + 1; $i < count($batteries) - 10; $i++) {
        if ($batteries[$i] > $n2['num']) {
            $n2['pos'] = $i;
            $n2['num'] = $batteries[$i];
        }
    }

    $n3 = ['pos' => 0, 'num' => 0];
    for ($i = $n2['pos'] + 1; $i < count($batteries) - 9; $i++) {
        if ($batteries[$i] > $n3['num']) {
            $n3['pos'] = $i;
            $n3['num'] = $batteries[$i];
        }
    }

    $n4 = ['pos' => 0, 'num' => 0];
    for ($i = $n3['pos'] + 1; $i < count($batteries) - 8; $i++) {
        if ($batteries[$i] > $n4['num']) {
            $n4['pos'] = $i;
            $n4['num'] = $batteries[$i];
        }
    }

    $n5 = ['pos' => 0, 'num' => 0];
    for ($i = $n4['pos'] + 1; $i < count($batteries) - 7; $i++) {
        if ($batteries[$i] > $n5['num']) {
            $n5['pos'] = $i;
            $n5['num'] = $batteries[$i];
        }
    }

    $n6 = ['pos' => 0, 'num' => 0];
    for ($i = $n5['pos'] + 1; $i < count($batteries) - 6; $i++) {
        if ($batteries[$i] > $n6['num']) {
            $n6['pos'] = $i;
            $n6['num'] = $batteries[$i];
        }
    }

    $n7 = ['pos' => 0, 'num' => 0];
    for ($i = $n6['pos'] + 1; $i < count($batteries) - 5; $i++) {
        if ($batteries[$i] > $n7['num']) {
            $n7['pos'] = $i;
            $n7['num'] = $batteries[$i];
        }
    }

    $n8 = ['pos' => 0, 'num' => 0];
    for ($i = $n7['pos'] + 1; $i < count($batteries) - 4; $i++) {
        if ($batteries[$i] > $n8['num']) {
            $n8['pos'] = $i;
            $n8['num'] = $batteries[$i];
        }
    }

    $n9 = ['pos' => 0, 'num' => 0];
    for ($i = $n8['pos'] + 1; $i < count($batteries) - 3; $i++) {
        if ($batteries[$i] > $n9['num']) {
            $n9['pos'] = $i;
            $n9['num'] = $batteries[$i];
        }
    }

    $n10 = ['pos' => 0, 'num' => 0];
    for ($i = $n9['pos'] + 1; $i < count($batteries) - 2; $i++) {
        if ($batteries[$i] > $n10['num']) {
            $n10['pos'] = $i;
            $n10['num'] = $batteries[$i];
        }
    }

    $n11 = ['pos' => 0, 'num' => 0];
    for ($i = $n10['pos'] + 1; $i < count($batteries) - 1; $i++) {
        if ($batteries[$i] > $n11['num']) {
            $n11['pos'] = $i;
            $n11['num'] = $batteries[$i];
        }
    }

    $n12 = ['pos' => 0, 'num' => 0];
    for ($i = $n11['pos'] + 1; $i < count($batteries); $i++) {
        if ($batteries[$i] > $n12['num']) {
            $n12['pos'] = $i;
            $n12['num'] = $batteries[$i];
        }
    }

    $joltage[] =
        ($n1['num'] * pow(10, 11)) +
        ($n2['num'] * pow(10, 10)) +
        ($n3['num'] * pow(10, 9)) +
        ($n4['num'] * pow(10, 8)) +
        ($n5['num'] * pow(10, 7)) +
        ($n6['num'] * pow(10, 6)) +
        ($n7['num'] * pow(10, 5)) +
        ($n8['num'] * pow(10, 4)) +
        ($n9['num'] * pow(10, 3)) +
        ($n10['num'] * pow(10, 2)) +
        ($n11['num'] * pow(10, 1)) +
        $n12['num'];
}

var_dump($joltage);

echo "sum of joltage: " . array_sum($joltage) . "\n";
