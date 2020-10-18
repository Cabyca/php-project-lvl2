<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use Differ;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $dataDifferFixture = (file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/DifferFixture'));

        $dataFunctionDiffer = Differ\genDiff('file1.json', 'file2.json');

        $this->assertEquals($dataDifferFixture, $dataFunctionDiffer);
    }
}
