<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\gendiff;

class DifferTest extends TestCase
{
    public function testJson(): void
    {
        $dataDifferFixture = (file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/DifferFixture'));

        $dataJson = genDiff(dirname(__DIR__) . '/' . 'tests/fixtures/file1.json', dirname(__DIR__) . '/' . 'tests/fixtures/file2.json');

        $this->assertEquals($dataDifferFixture, $dataJson);
    }

    public function testYaml(): void
    {
        $dataDifferFixture = (file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/DifferFixture'));

        $dataYaml = genDiff(dirname(__DIR__) . '/' . 'tests/fixtures/filepath1.yml', dirname(__DIR__) . '/' . 'tests/fixtures/filepath2.yml');

        $this->assertEquals($dataDifferFixture, $dataYaml);
    }
}
