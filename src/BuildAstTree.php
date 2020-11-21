<?php

namespace Differ\BuildAstTree;

function buildAstTree(array $data1, array $data2): array
{

    $keysData1 = array_keys($data1);
    $keysData2 = array_keys($data2);
    $uniqueKeys = array_unique(array_merge($keysData1, $keysData2));
    sort($uniqueKeys);


    $astTree = array_map(function ($key) use ($data1, $data2) {

        if (!array_key_exists($key, $data1)) {
            return ['key' => $key, 'type' => 'added', 'value' => $data2[$key]];
        }
        if (!array_key_exists($key, $data2)) {
            return ['key' => $key, 'type' => 'removed', 'value' => $data1[$key]];
        }
        if (is_array($data1[$key]) && is_array($data2[$key])) {
            return ['key' => $key, 'type' => 'nested', 'children' => buildAstTree($data1[$key], $data2[$key])];
        }
        if ($data1[$key] !== $data2[$key]) {
            $unchangedValues = ['valueRemoved' => $data1[$key], 'valueAdd' => $data2[$key]];
            return ['key' => $key, 'type' => 'changed', 'value' => $unchangedValues];
        }
        return ['key' => $key, 'type' => 'unchanged', 'value' => $data1[$key]];
    }, $uniqueKeys);

    return array_values($astTree);
}
