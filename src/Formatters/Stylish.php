<?php

namespace Differ\Stylish;

use function Differ\BooleanConversion\booleanConversion;

function stylish(array $astTree, int $depth)
{

    $indent = str_repeat(" ", $depth);

    $result = array_map(function ($node) use ($depth, $indent) {
        $depth += 4;
        switch ($node['type']) {
            case 'nested':
                return $indent . "    " . $node['key'] . ": " . stylish($node['children'], $depth) . PHP_EOL;
            case 'added':
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "  + " . $node['key'] . ": " . booleanConversion($typeNode) . PHP_EOL;
            case 'removed':
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "  - " . $node['key'] . ": " . booleanConversion($typeNode) . PHP_EOL;
            case 'changed':
                $typeNode1 = nodeIsArray($node['value'][0], $depth);
                $typeNode2 = nodeIsArray($node['value'][1], $depth);
                $valueOfChangedNode1 = $node['key'] . ": " . booleanConversion($typeNode1) . PHP_EOL;
                $valueOfChangedNode2 = $node['key'] . ": " . booleanConversion($typeNode2);                         
                return $indent . "  - " . $valueOfChangedNode1 . $indent . "  + " . $valueOfChangedNode2 . PHP_EOL;
            default:
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "    " . $node['key'] . ": " . booleanConversion($typeNode) . PHP_EOL;
        }
    }, $astTree);
    return '{' . PHP_EOL . implode("", $result) . $indent . '}';
}

function nodeIsArray ($value, $depth)
{
    return is_array($value) ? indentation($value, $depth) : $value;
} 

function indentation($arr, $depth)
{
    $indent = str_repeat(" ", $depth);
    $stringOfArray = array_map(function ($key, $item) use ($depth, $indent) {
        $depth = $depth + 4;
        $typeOfValueOfNode = (is_array($item)) ? indentation($item, $depth) : $item;
        return $indent . "    " . "{$key}: " . booleanConversion($typeOfValueOfNode) . PHP_EOL;
    }, array_keys($arr), $arr);
    return '{' . PHP_EOL . implode("", $stringOfArray) . $indent . '}';
}
