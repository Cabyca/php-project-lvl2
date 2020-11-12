<?php

namespace Formatters;

use function Stylish\stylish;
use function Plain\plain;

function formatters($astTree, $formatName = 'stylish')
{
    switch ($formatName) {
        case 'stylish':
            return stylish($astTree, $depth = 0);
        case 'plain':
            return plain($astTree, $nestedProperty = '');
        default:
            return 'Wrong format' . PHP_EOL;
    }
}
