<?php

namespace Differ\Formatters\Plain;

use function Differ\CheckBoolean\checkBoolean;

function plain($astTree, $nestedProperty)
{

    $result = array_map(function ($node) use ($nestedProperty) {
        switch ($node['type']) {
            case 'nested':
                $nestedProperty .=  $node['key'] . ".";
                return plain($node['children'], $nestedProperty);
            case 'added':
                $typeOfValueOfNode = (is_array($node['value'])) ? '[complex value]' : $node['value'];
                $valueOfAddedNode = checkBoolean($typeOfValueOfNode, $plain = 1) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . $valueOfAddedNode;
            case 'removed':
                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;
            case 'changed':
                $valueRemoved = $node['value']['valueRemoved'];
                $valueAdded = $node['value']['valueAdd'];
                $typeOfValueOfNode1 = (is_array($valueRemoved)) ? '[complex value]' : $valueRemoved;
                $typeOfValueOfNode2 = (is_array($valueAdded)) ? '[complex value]' : $valueAdded;
                $node1 = "From " . checkBoolean($typeOfValueOfNode1, $plain = 1);
                $node2 = " to " . checkBoolean($typeOfValueOfNode2, $plain = 1) . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was updated. " . $node1 . $node2;
            case 'unchanged':
                return "Property '" . $nestedProperty . $node['key'] . "' unchanged" . PHP_EOL;
        }
    }, $astTree);

    return implode("", $result);
}
