<?php

namespace Differ\Plain;

use function Differ\BooleanConversion\booleanConversion;

function plain($astTree, $nestedProperty)
{

    $result = array_map(function ($node) use ($nestedProperty) {
        switch ($node['type']) {
            case 'nested':
                $nestedProperty .=  $node['key'] . ".";
                return plain($node['children'], $nestedProperty);
            case 'added':
                $typeOfValueOfNode = (is_array($node['value'])) ? '[complex value]' : $node['value'];
                $valueOfAddedNode = booleanConversion($typeOfValueOfNode, $plain = 1) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . $valueOfAddedNode;
            case 'removed':
                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;
            case 'changed':
                $typeOfValueOfNode1 = (is_array($node['value'][0])) ? '[complex value]' : $node['value'][0];
                $typeOfValueOfNode2 = (is_array($node['value'][1])) ? '[complex value]' : $node['value'][1];
                $valueOfChangedNode1 = "From " . booleanConversion($typeOfValueOfNode1, $plain = 1);
                $valueOfChangedNode2 = " to " . booleanConversion($typeOfValueOfNode2, $plain = 1) . PHP_EOL;   
                return "Property '" . $nestedProperty . $node['key'] . "' was updated. " . $valueOfChangedNode1 . $valueOfChangedNode2;
            case 'unchanged':
                return "Property '" . $nestedProperty . $node['key'] . "' unchanged" . PHP_EOL;
        }
    }, $astTree);

    return implode("", $result);
}
