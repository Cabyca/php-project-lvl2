<?php

namespace Differ;

function genDiff($pathToFile1, $pathToFile2)
{

    $data1 = json_decode(file_get_contents($pathToFile1), true);
    ksort($data1);
    foreach ($data1 as $key => $value) {
        if (is_bool($value)) {
            $data1[$key] = boolval($value) ? 'true' : 'false';
        }
    }

    $data2 = json_decode(file_get_contents($pathToFile2), true);
    ksort($data2);
    foreach ($data2 as $key => $value) {
        if (is_bool($value)) {
            $data2[$key] = boolval($value) ? 'true' : 'false';
        }
    }

    $dataСonsolidation = array_merge($data2, $data1);
    ksort($dataСonsolidation);

    $differenceResult = [];

    foreach ($dataСonsolidation as $key => $value) {

        if (!array_key_exists($key, $data2)) {
            $differenceResult[] = "  - {$key}: {$value}" . PHP_EOL;
        }

        if (array_key_exists($key, $data2)) {
            if (!array_key_exists($key, $data1)) {
                $differenceResult[] = "  + {$key}: {$value}" . PHP_EOL;
            } elseif ($dataСonsolidation[$key] === $data2[$key]) {
                $differenceResult[] = "    {$key}: {$value}" . PHP_EOL;
            }
            if ($dataСonsolidation[$key] !== $data2[$key]) {
                $differenceResult[] = "  - {$key}: {$dataСonsolidation[$key]}" . PHP_EOL;
                $differenceResult[] = "  + {$key}: {$data2[$key]}" . PHP_EOL;
            }
        }
    }

    return '{' . PHP_EOL . implode("", $differenceResult) . '}' . PHP_EOL;
}
