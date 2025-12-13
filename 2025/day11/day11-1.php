<?php

$input = [
    'aaa: you hhh',
    'you: bbb ccc',
    'bbb: ddd eee',
    'ccc: ddd eee fff',
    'ddd: ggg',
    'eee: out',
    'fff: out',
    'ggg: out',
    'hhh: ccc fff iii',
    'iii: out',
];

$input = explode("\n", trim(file_get_contents("input.txt")));

$routes = [];
foreach ($input as $route) {
    $matches = [];
    preg_match_all('/^(\w*):\s(.*+)$/', $route, $matches);

    $routes[$matches[1][0]] = explode(' ', $matches[2][0]);
}

$count = 0;
findRoute($routes, $routes['you'], $count);

echo "found $count routes\n";

function findRoute($routes, $devices, &$count) {
    foreach ($devices as $device) {
        if ($device == 'out') {
            $count++;
            return;
        }

        findRoute($routes, $routes[$device], $count);
    }
}

