<?php

namespace Differ\Formatters\Plain;

use function Differ\CheckBoolean\checkBoolean;

function render($astTree)
{
    return plain($astTree);
}

function plain($astTree, $nestedProperty = '')
{

    $result = array_map(function ($node) use ($nestedProperty) {
        switch ($node['type']) {
            case 'nested':
                $nestedProperty .=  $node['key'] . ".";
                return plain($node['children'], $nestedProperty);
            case 'added':
                $typeOfValueOfNode = (is_object($node['value'])) ? '[complex value]' : $node['value'];
                $valueOfAddedNode = checkString($typeOfValueOfNode) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . $valueOfAddedNode;
            case 'removed':
                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;
            case 'changed':
                $valueRemoved = $node['value']['valueRemoved'];
                $valueAdded = $node['value']['valueAdd'];
                $typeOfValueOfNode1 = (is_object($valueRemoved)) ? '[complex value]' : $valueRemoved;
                $typeOfValueOfNode2 = (is_object($valueAdded)) ? '[complex value]' : $valueAdded;
                $node1 = "From " . checkString($typeOfValueOfNode1);
                $node2 = " to " . checkString($typeOfValueOfNode2) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was updated. " . $node1 . $node2;
        }
    }, $astTree);

    return implode("", $result);
}

function checkString($value)
{
    if ($value === '[complex value]') {
        return $value;
    }
    return is_string($value) ? "'" . $value . "'" : checkBoolean($value, 1);
}
