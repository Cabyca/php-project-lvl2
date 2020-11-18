<?php

namespace Differ\Render;

use function Differ\Formatters\Stylish\stylish;
use function Differ\Formatters\Plain\plain;
use function Differ\Formatters\Json\json;

function render($astTree, $formatName)
{
    switch ($formatName) {
        case 'plain':
            return plain($astTree, $nestedProperty = '');
        case 'json':
            return json($astTree);
        default:
            return stylish($astTree, $depth = 0);
    }
}
