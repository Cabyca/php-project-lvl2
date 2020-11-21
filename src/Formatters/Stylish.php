<?php

namespace Differ\Formatters\Stylish;

use function Differ\CheckBoolean\checkBoolean;

function stylish(array $astTree, int $depth)
{
    $indent = buildIndent($depth, 4);

    $result = array_map(function ($node) use ($depth, $indent) {
        $depth += 1;
        switch ($node['type']) {
            case 'nested':
                return $indent . "    " . $node['key'] . ": " . stylish($node['children'], $depth) . PHP_EOL;
            case 'added':
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "  + " . $node['key'] . ": " . checkBoolean($typeNode) . PHP_EOL;
            case 'removed':
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "  - " . $node['key'] . ": " . checkBoolean($typeNode) . PHP_EOL;
            case 'changed':
                $typeNode1 = nodeIsArray($node['value']['valueRemoved'], $depth);
                $typeNode2 = nodeIsArray($node['value']['valueAdd'], $depth);
                $valueOfChangedNode1 = $node['key'] . ": " . checkBoolean($typeNode1) . PHP_EOL;
                $valueOfChangedNode2 = $node['key'] . ": " . checkBoolean($typeNode2);
                return $indent . "  - " . $valueOfChangedNode1 . $indent . "  + " . $valueOfChangedNode2 . PHP_EOL;
            default:
                $typeNode = nodeIsArray($node['value'], $depth);
                return $indent . "    " . $node['key'] . ": " . checkBoolean($typeNode) . PHP_EOL;
        }
    }, $astTree);
    return '{' . PHP_EOL . implode("", $result) . $indent . '}';
}

function buildIndent($depth, $quantityOfGaps)
{
    $spaceMultiplier = $depth * $quantityOfGaps;
    return str_repeat(" ", $spaceMultiplier);
}

function nodeIsArray($value, $depth)
{
    return is_array($value) ? addNodeAsArray($value, $depth) : $value;
}

function addNodeAsArray($arr, $depth)
{
    $indent = buildIndent($depth, 4);
    $stringOfArray = array_map(function ($key, $item) use ($depth, $indent) {
        $depth += 1;
        $typeOfValueOfNode = (is_array($item)) ? addNodeAsArray($item, $depth) : $item;
        return $indent . "    " . "{$key}: " . checkBoolean($typeOfValueOfNode) . PHP_EOL;
    }, array_keys($arr), $arr);
    return '{' . PHP_EOL . implode("", $stringOfArray) . $indent . '}';
}
