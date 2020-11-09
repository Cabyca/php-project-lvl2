<?php

namespace Differ;

use function Parsers\parsers;
use function BildingDiff\bildingDiff;
use function Formatter\formatter;

function genDiff(string $file1, string $file2): string
{
    [$data1, $data2] = parsers($file1, $file2);

    $ASTTree = bildingDiff($data1, $data2);

    print_r($ASTTree);

    return formatter($ASTTree, $depth = 0);
}
