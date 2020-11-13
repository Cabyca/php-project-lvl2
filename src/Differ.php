<?php

namespace Differ;

use function Parsers\parsers;
use function BildingDiff\bildingDiff;
use function Formatters\formatters;

function genDiff(string $file1, string $file2, $formatName): string
{
    [$data1, $data2] = parsers($file1, $file2);

    $ASTTree = bildingDiff($data1, $data2);

    $resultDiff = formatters($ASTTree, $formatName);

    return $resultDiff;
}
