<?php

namespace Differ\GetData;

use Exception;

function getData($pathToFile)
{
    if (!file_exists($pathToFile)) {
        throw new Exception("The file does not exist: $pathToFile");
    }

    $dataParsing = file_get_contents($pathToFile);
    $extensionFile = pathinfo($pathToFile, PATHINFO_EXTENSION);

    return [$dataParsing, $extensionFile];
}
