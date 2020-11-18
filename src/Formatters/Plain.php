<?php

namespace Differ\Formatters\Plain;

use function Differ\CheckForBoolean\checkForBoolean;

function plain($astTree, $nestedProperty)
{

    $result = array_map(function ($node) use ($nestedProperty) {
        switch ($node['type']) {
            case 'nested':
                $nestedProperty .=  $node['key'] . ".";
                return plain($node['children'], $nestedProperty);
            case 'added':
                $typeOfValueOfNode = (is_array($node['value'])) ? '[complex value]' : $node['value'];
                $valueOfAddedNode = checkForBoolean($typeOfValueOfNode, $plain = 1) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . $valueOfAddedNode;
            case 'removed':
                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;
            case 'changed':
                $typeOfValueOfNode1 = (is_array($node['value'][0])) ? '[complex value]' : $node['value'][0];
                $typeOfValueOfNode2 = (is_array($node['value'][1])) ? '[complex value]' : $node['value'][1];
                $node1 = "From " . checkForBoolean($typeOfValueOfNode1, $plain = 1);
                $node2 = " to " . checkForBoolean($typeOfValueOfNode2, $plain = 1) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was updated. " . $node1 . $node2;
            case 'unchanged':
                return "Property '" . $nestedProperty . $node['key'] . "' unchanged" . PHP_EOL;
        }
    }, $astTree);

    return implode("", $result);
}
