<?php

namespace Formatters;

use function Stylish\stylish;
use function Plain\plain;
use function Json\json;

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
