<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parsers($dataForParsing, $dataType)
{
    switch ($dataType) {
        case 'json':
            return json_decode($dataForParsing, true);
        case 'yml':
            return Yaml::parse($dataForParsing);
        default:
            print_r(true);
    }
}
