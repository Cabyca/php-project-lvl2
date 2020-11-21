<?php

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\gendiff;

class DifferTest extends TestCase
{
    public function testJsonFormatStylish(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffStylish');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.json', 'file4.json');

        $dataJson = genDiff($pathToFile1, $pathToFile2, 'stylish');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatStylish(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffStylish');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.yml', 'file4.yml');

        $dataYaml = genDiff($pathToFile1, $pathToFile2, 'stylish');

        $this->assertEquals($dataDiff, $dataYaml);
    }

    public function testJsonFormatPlain(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffPlain');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.json', 'file4.json');

        $dataJson = genDiff($pathToFile1, $pathToFile2, 'plain');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatPlain(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffPlain');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.yml', 'file4.yml');

        $dataYaml = genDiff($pathToFile1, $pathToFile2, 'plain');

        $this->assertEquals($dataDiff, $dataYaml);
    }

    public function testJsonFormatJson(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffJson');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.json', 'file4.json');

        $dataJson = genDiff($pathToFile1, $pathToFile2, 'json');

        $this->assertEquals($dataDiff, $dataJson);
    }

    public function testYamlFormatJson(): void
    {
        $dataDiff = file_get_contents(dirname(__DIR__) . '/' . 'tests/fixtures/diffJson');

        [$pathToFile1, $pathToFile2] = $this->returnPathsFiles('file3.yml', 'file4.yml');

        $dataYaml = genDiff($pathToFile1, $pathToFile2, 'json');

        $this->assertEquals($dataDiff, $dataYaml);
    }

    public function returnPathsFiles(string $nameFile1, string $nameFile2)
    {
        $pathToFile1 = dirname(__DIR__, 1) . '/tests/fixtures/' . $nameFile1;
        $pathToFile2 = dirname(__DIR__, 1) . '/tests/fixtures/' . $nameFile2;

        return [$pathToFile1, $pathToFile2];
    }
}
