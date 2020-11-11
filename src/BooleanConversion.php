<?php

namespace BooleanConversion;

function booleanConversion($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_null($value)) {
        return 'null';
    }
    return $value;
}
