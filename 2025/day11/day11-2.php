<?php

$input = [
    'svr: aaa bbb',
    'aaa: fft',
    'fft: ccc',
    'bbb: tty',
    'tty: ccc',
    'ccc: ddd eee',
    'ddd: hub',
    'hub: fff',
    'eee: dac',
    'dac: fff',
    'fff: ggg hhh',
    'ggg: out',
    'hhh: out',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$routes = [];
foreach ($input as $route) {
    $matches = [];
    preg_match_all('/^(\w*):\s(.*+)$/', $route, $matches);

    $routes[$matches[1][0]] = explode(' ', $matches[2][0]);
}

function findRoute($device, $endDevice, &$cache) {
    global $routes;

    if ($device == $endDevice) {
        return 1;
    }

    if ($device == 'out') {
        return 0;
    }

    if (isset($cache[$device])) {
        return $cache[$device];
    }

    $total = 0;
    foreach ($routes[$device] as $d) {
        $total += findRoute($d, $endDevice, $cache);
    }

    $cache[$device] = $total;

    return $total;
}

$a1Cache = [];
$a1 = findRoute('svr', 'fft', $a1Cache);

$a2Cache = [];
$a2 = findRoute('fft', 'dac', $a2Cache);

$a3Cache = [];
$a3 = findRoute('dac', 'out', $a3Cache);

$b1Cache = [];
$b1 = findRoute('svr', 'dac', $b1Cache);

$b2Cache = [];
$b2 = findRoute('dac', 'fft', $b2Cache);

$b3Cache = [];
$b3 = findRoute('fft', 'out', $b3Cache);

$total = ($a1 * $a2 * $a3) + ($b1 * $b2 * $b3);

var_dump($total);
