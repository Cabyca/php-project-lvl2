<?php

namespace Differ\Formatters\Json;

function render($astTree)
{
    return json($astTree);
}

function json(array $astTree)
{
    return json_encode($astTree);
}
