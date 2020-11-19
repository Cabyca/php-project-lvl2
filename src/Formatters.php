<?php

namespace Differ\Formatters;

use Exception;

use function Differ\Render\render;

function formatters($astTree, $formatName = 'stylish')
{
    switch ($formatName) {
        case 'stylish':
            return render($astTree, $formatName);
        case 'plain':
            return render($astTree, $formatName = 'plain');
        case 'json':
            return render($astTree, $formatName = 'json');
        default:
            throw new Exception("Unknown formatter: $formatName");
    }
}
