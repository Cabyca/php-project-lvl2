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
                $value = (is_object($node['value'])) ? '[complex value]' : checkString($node['value']);
                return "Property '" . $nestedProperty . $node['key'] . "' was added with value: " . $value . PHP_EOL;
            case 'removed':
                return "Property '" . $nestedProperty . $node['key'] . "' was removed" . PHP_EOL;
            case 'changed':
                $node1 = $node['value']['valueRemoved'];
                $node2 = $node['value']['valueAdd'];
                $valueRemoved = (is_object($node1)) ? '[complex value]' : checkString($node1);
                $valueAdded = (is_object($node2)) ? '[complex value]' : checkString($node2);
                $nodeRemoved = "From " . $valueRemoved;
                $nodeAdded = " to " . $valueAdded . PHP_EOL;
                return "Property '" . $nestedProperty . $node['key'] . "' was updated. " . $nodeRemoved . $nodeAdded;
        }
    }, $astTree);

    return implode("", $result);
}

function checkString($value)
{
    return is_string($value) ? "'{$value}'" : checkBoolean($value, 1);
}
