<?php

namespace Differ\Formatters;

use function Differ\Render\render;

function chooseRenderForFormate($astTree, $formatName)
{
    switch ($formatName) {
        case 'plain':
            return render($astTree, $formatName = 'plain');
        case 'json':
            return render($astTree, $formatName = 'json');
        default:
            return render($astTree, $formatName = 'stylish');
    }
}
