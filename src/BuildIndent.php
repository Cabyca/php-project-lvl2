<?php

namespace Differ\BuildIndent;

function buildIndent($depth, $quantityOfGaps)
{
    $spaceMultiplier = $depth * $quantityOfGaps;
    return str_repeat(" ", $spaceMultiplier);
}
