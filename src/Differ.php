<?php

namespace Differ\Differ;

use function Differ\Parser\parser;
use function Differ\BuildOfAstTree\buildOfAstTree;
use function Differ\Formatters\chooseRenderForFormate;

function genDiff(string $pathToFile1, string $pathToFile2, $formatName): string
{
    $dataForParsing1 = file_get_contents($pathToFile1);
    $dataForParsing2 = file_get_contents($pathToFile2);
    $extensionFile1 = pathinfo($pathToFile1, PATHINFO_EXTENSION);
    $extensionFile2 = pathinfo($pathToFile2, PATHINFO_EXTENSION);

    if ($extensionFile1 === 'json' && $extensionFile2 === 'json') {
        $data1 = parser($dataForParsing1, $dataType = 'json');
        $data2 = parser($dataForParsing2, $dataType = 'json');
    } elseif ($extensionFile1 === 'yml' && $extensionFile2 === 'yml') {
        $data1 = parser($dataForParsing1, $dataType = 'yml');
        $data2 = parser($dataForParsing2, $dataType = 'yml');
    }

    $astTree = buildOfAstTree($data1, $data2);

    $resultOfDiff = chooseRenderForFormate($astTree, $formatName);

    return $resultOfDiff;
}
