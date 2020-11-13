<?php

namespace Stylish;

use function BooleanConversion\booleanConversion;

function stylish(array $astTree, int $depth)
{

    $indent = str_repeat(" ", $depth);

    $result = array_map(function ($node) use ($depth, $indent) {


        $depth += 4;

        switch ($node['type']) {
            case 'nested':
                return $indent . "    " . $node['key'] . ": " . stylish($node['children'], $depth) . PHP_EOL;
            case 'added':
                $typeOfValueOfNode = (is_array($node['value'])) ? helper($node['value'], $depth) : $node['value'];
                return $indent . "  + " . $node['key'] . ": " . booleanConversion($typeOfValueOfNode) . PHP_EOL;
            case 'removed':
                $typeOfValueOfNode = (is_array($node['value'])) ? helper($node['value'], $depth) : $node['value'];
                return $indent . "  - " . $node['key'] . ": " . booleanConversion($typeOfValueOfNode) . PHP_EOL;
            case 'changed':
                $typeOfValueOfNode1 = (is_array($node['value'][0])) ? helper($node['value'][0], $depth) : $node['value'][0];
                $typeOfValueOfNode2 = (is_array($node['value'][1])) ? helper($node['value'][1], $depth) : $node['value'][1];
                return $indent . "  - " . $node['key'] . ": " . booleanConversion($typeOfValueOfNode1) . PHP_EOL . $indent . "  + " . $node['key'] . ": " . booleanConversion($typeOfValueOfNode2) . PHP_EOL;
            default:
                $typeOfValueOfNode = (is_array($node['value'])) ? helper($node['value'], $depth) : $node['value'];
                return $indent . "    " . $node['key'] . ": " . booleanConversion($typeOfValueOfNode) . PHP_EOL;
        }
    }, $astTree);
    return '{' . PHP_EOL . implode("", $result) . $indent . '}';
}

function helper($arr, $depth)
{

    $indent = str_repeat(" ", $depth);

    $stringOfArray = array_map(function ($key, $item) use ($depth, $indent) {

        $depth = $depth + 4;

        $typeOfValueOfNode = (is_array($item)) ? helper($item, $depth) : $item;

        return $indent . "    " . "{$key}: " . booleanConversion($typeOfValueOfNode) . PHP_EOL;
    }, array_keys($arr), $arr);

    return '{' . PHP_EOL . implode("", $stringOfArray) . $indent . '}';
}
