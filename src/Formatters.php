<?php

namespace Differ\Formatters;

use function Differ\Render\render;

function formatters($astTree, $formatName)
{
    return render($astTree, $formatName);
}
