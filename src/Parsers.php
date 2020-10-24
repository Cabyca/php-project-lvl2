<?php

namespace Parsers;

use Symfony\Component\Yaml\Yaml;

function parsers(string $file1, string $file2): array
{
    $pathToFile1 = dirname(__DIR__, 1) . '/tests/fixtures/' . $file1;
    $pathToFile2 = dirname(__DIR__, 1) . '/tests/fixtures/' . $file2;
    $extensionFile1 = pathinfo($pathToFile1, PATHINFO_EXTENSION);
    $extensionFile2 = pathinfo($pathToFile2, PATHINFO_EXTENSION);

    if ($extensionFile1 === 'json' && $extensionFile2 === 'json') {
        $data1 = json_decode((string) file_get_contents($pathToFile1), true);
        $data2 = json_decode((string) file_get_contents($pathToFile2), true);
    } elseif ($extensionFile1 === 'yml' && $extensionFile2 === 'yml') {
        $data1 = Yaml::parseFile($pathToFile1);
        $data2 = Yaml::parseFile($pathToFile2);
    }

    return [$data1, $data2];
}
