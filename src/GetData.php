<?php

namespace Differ\GetData;

use Exception;

function getData($pathToFile1, $pathToFile2)
{
    if (!file_exists($pathToFile1)) {
        throw new Exception("The file does not exist: $pathToFile1");
    }
    if (!file_exists($pathToFile2)) {
        throw new Exception("The file does not exist: $pathToFile2");
    }

    $dataParsing1 = file_get_contents($pathToFile1);
    $dataParsing2 = file_get_contents($pathToFile2);
    $extensionFile1 = pathinfo($pathToFile1, PATHINFO_EXTENSION);
    $extensionFile2 = pathinfo($pathToFile2, PATHINFO_EXTENSION);

    return [$dataParsing1, $dataParsing2, $extensionFile1, $extensionFile2];
}
