<?php

namespace Differ\Formatters;

use function Differ\Stylish\stylish;
use function Differ\Plain\plain;
use function Differ\Json\json;

function formatters($astTree, $formatName = 'stylish')
{
    switch ($formatName) {
        case 'stylish':
            return stylish($astTree, $depth = 0);
        case 'plain':
            return plain($astTree, $nestedProperty = '');
        case 'json':
            return json($astTree);
        default:
            return 'Wrong format' . PHP_EOL;
    }
}
