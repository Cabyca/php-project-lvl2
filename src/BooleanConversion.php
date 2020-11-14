<?php

namespace Differ\BooleanConversion;

function booleanConversion($value, $plain = 0)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    if ($plain === 1 && $value === '') {
        return $value = "''";
    }
    return $value;
}
