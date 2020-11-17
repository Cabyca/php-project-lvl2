<?php

namespace Differ\Differ;

use function Differ\Parsers\parsers;
use function Differ\BildingDiff\bildingDiff;
use function Differ\Formatters\formatters;

function genDiff(string $pathToFile1, string $pathToFile2, $formatName): string
{
    $dataForParsing1 = file_get_contents($pathToFile1);
    $dataForParsing2 = file_get_contents($pathToFile2);
    $extensionFile1 = pathinfo($pathToFile1, PATHINFO_EXTENSION);
    $extensionFile2 = pathinfo($pathToFile2, PATHINFO_EXTENSION);

    if ($extensionFile1 === 'json' && $extensionFile2 === 'json') {
        $data1 = parsers($dataForParsing1, $dataType = 'json');
        $data2 = parsers($dataForParsing2, $dataType = 'json');
    } elseif ($extensionFile1 === 'yml' && $extensionFile2 === 'yml') {
        $data1 = parsers($dataForParsing1, $dataType = 'yml');
        $data2 = parsers($dataForParsing2, $dataType = 'yml');
    }

    $ASTTree = bildingDiff($data1, $data2);

    $resultDiff = formatters($ASTTree, $formatName);

    return $resultDiff;
}
