<?php

namespace Differ\CheckBoolean;

function checkBoolean($value, $plain = 0)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if ($value === '' && $plain === 1) {
        return $value = "''";
    }
    if (!is_object($value)) {
        return (string) $value;
    }
    return $value;
}
