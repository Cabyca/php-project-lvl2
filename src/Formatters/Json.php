<?php

namespace Differ\Formatters\Json;

function json(array $astTree)
{
    return json_encode($astTree);
}
