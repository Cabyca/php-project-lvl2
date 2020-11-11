<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\gendiff;

class DifferTest extends TestCase
{
    public function testJson(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diff');

        $dataJson = genDiff('file3.json', 'file4.json');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYaml(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diff');

        $dataYaml = genDiff('file3.yml', 'file4.yml');

        $this->assertEquals($dataDiff, $dataYaml);
    }
}
