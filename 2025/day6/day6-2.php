<?php

$input = [
    '000 000 000 000',
    '123 328  51 64 ',
    ' 45 64  387 23 ',
    '  6 98  215 314',
    '*   +   *   +  ',
];

$input = explode("\n", file_get_contents("input.txt"));

$d = [];

$input[4] = $input[4] . " ";

$lengths = preg_split('/(\+\s+|\*\s+)[\s]/', $input[4], null, PREG_SPLIT_DELIM_CAPTURE);
$lengths = array_values(array_filter($lengths));
$lengths = array_map(fn($item) => strlen($item), $lengths);

for ($i = 0; $i < 4; $i++) {
    $pos = 0;
    foreach ($lengths as $length) {
        $string = substr($input[$i], $pos, $length);
        $d[$i][] = $string;
        $pos += $length + 1;
    }
}

$d[4] = preg_split('/\s+/', trim($input[4]));

for ($i = 0; $i < count($d[4]); $i++) {
    $num1 = $d[0][$i];
    $num2 = $d[1][$i];
    $num3 = $d[2][$i];
    $num4 = $d[3][$i];
    $op = $d[4][$i];

    $tot = ($op == '*' ? 1 : 0);
    for ($j = 0; $j < $lengths[$i]; $j++) {
        $number = $num1[$j] . $num2[$j] . $num3[$j] . $num4[$j];
        $number = ltrim($number, ' 0');
        $number = (int) $number;

        if ($number == 0) { continue; }

        switch ($op) {
            case '+':
                $tot += $number;
                break;
            case '*':
                $tot = $tot * $number;
                break;
        }
    }

    $d[5][$i] = $tot;
}

echo "total: " . array_sum($d[5]) . "\n";
