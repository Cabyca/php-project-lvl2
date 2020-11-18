<?php

namespace Differ\Parser;

use Symfony\Component\Yaml\Yaml;
use Exception;

function parser($dataForParsing, $dataType)
{
    switch ($dataType) {
        case 'json':
            return json_decode($dataForParsing, true);
        case 'yml':
            return Yaml::parse($dataForParsing);
        default:
            throw new Exception("Unknown data type: $dataType");
    }
}
