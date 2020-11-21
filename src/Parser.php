<?php

namespace Differ\Parser;

use Symfony\Component\Yaml\Yaml;
use Exception;

function parser($data, $dataType)
{
    switch ($dataType) {
        case 'json':
            return json_decode($data, true);
        case 'yml':
        case 'yaml':
            return Yaml::parse($data);
        default:
            throw new Exception("Unknown data type: $dataType");
    }
}
