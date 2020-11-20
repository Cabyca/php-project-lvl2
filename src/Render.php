<?php

namespace Differ\Render;

use Exception;

use function Differ\Formatters\Stylish\stylish;
use function Differ\Formatters\Plain\plain;
use function Differ\Formatters\Json\json;

function render($astTree, $formatName = 'stylish')
{
    switch ($formatName) {
        case 'stylish':
            return stylish($astTree, $depth = 0);
        case 'plain':
            return plain($astTree, $nestedProperty = '');
        case 'json':
            return json($astTree);
        default:
            throw new Exception("Unknown formatter: $formatName");
    }
}
