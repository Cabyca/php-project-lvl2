<?php

namespace Differ\buildIndent;

function buildIndent($depth)
{
    $quantityOfGaps = 4;
    $spaceMultiplier = $depth * $quantityOfGaps;
    return str_repeat(" ", $spaceMultiplier);
}
