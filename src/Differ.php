<?php

namespace Differ\Differ;

use function Differ\Parser\parser;
use function Differ\BuildOfAstTree\buildOfAstTree;
use function Differ\Formatters\formatters;
use function Differ\Getdata\getData;

function genDiff(string $pathToFile1, string $pathToFile2, $formatName): string
{
    [$dataParsing1, $dataParsing2, $extensionFile1, $extensionFile2] = getData($pathToFile1, $pathToFile2);

    $data1 = parser($dataParsing1, $extensionFile1);
    $data2 = parser($dataParsing2, $extensionFile2);

    $astTree = buildOfAstTree($data1, $data2);

    $resultOfDiff = formatters($astTree, $formatName);

    return $resultOfDiff;
}
