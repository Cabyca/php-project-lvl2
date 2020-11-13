<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\gendiff;

class DifferTest extends TestCase
{
    public function testJsonFormatStylish(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffStylish');

        $dataJson = genDiff('file3.json', 'file4.json', 'stylish');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatStylish(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffStylish');

        $dataYaml = genDiff('file3.yml', 'file4.yml', 'stylish');

        $this->assertEquals($dataDiff, $dataYaml);
    }

    public function testJsonFormatPlain(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffPlain');

        $dataJson = genDiff('file3.json', 'file4.json', 'plain');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatPlain(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffPlain');

        $dataYaml = genDiff('file3.yml', 'file4.yml', 'plain');

        $this->assertEquals($dataDiff, $dataYaml);
    }

    public function testJsonFormatJson(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffJson');

        $dataJson = genDiff('file3.json', 'file4.json', 'json');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatJson(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffJson');

        $dataYaml = genDiff('file3.yml', 'file4.yml', 'json');

        $this->assertEquals($dataDiff, $dataYaml);
    }
}
