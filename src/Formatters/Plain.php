<?php

namespace Plain;

use function BooleanConversion\booleanConversion;

function plain($astTree, $nestedProperty)
{

    $result = array_map(function ($node) use ($nestedProperty) {

        switch ($node['type']) {

            case 'nested':

                $nestedProperty .=  $node['key'] . ".";

                return plain($node['children'], $nestedProperty);

            case 'added':

                $typeOfValueOfNode = (is_array($node['value'])) ? '[complex value]' : $node['value'];

                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . booleanConversion($typeOfValueOfNode, $plain = 1) . PHP_EOL;

            case 'removed':

                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;

            case 'changed':

                $typeOfValueOfNode1 = (is_array($node['value'][0])) ? '[complex value]' : $node['value'][0];
                $typeOfValueOfNode2 = (is_array($node['value'][1])) ? '[complex value]' : $node['value'][1];

                return "Property '" . $nestedProperty . $node['key'] . "' was updated. From " . booleanConversion($typeOfValueOfNode1, $plain = 1) . " to " . booleanConversion($typeOfValueOfNode2, $plain = 1) . PHP_EOL;

            case 'unchanged':

                return "Property '" . $nestedProperty . $node['key'] . "' unchanged" . PHP_EOL;
        }
    }, $astTree);

    return implode("", $result);
}
