<?php

namespace Tests\Unit;

use Tests\TestCase;

class AsiaYoTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * 請使用你/妳擅長的語言實作一個 numeric format string function，依照每三位數標出逗號。
     * First case format thousand numeric
     * e.g.
     * f(9527) => “9,527”
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertThousandNumeric()
    {
        $this->assertEquals("9,527", $this->numericFormat("9527"));
    }

    /**
     * 請使用你/妳擅長的語言實作一個 numeric format string function，依照每三位數標出逗號。
     * Second case format million numeric
     * e.g.
     * f(3345678) => “3,345,678”
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertMillionsNumeric()
    {
        $this->assertEquals("3,345,678", $this->numericFormat("3345678"));
    }

    /**
     * 請使用你/妳擅長的語言實作一個 numeric format string function，依照每三位數標出逗號。
     * Third case format negative numeric and float point numeric
     * e.g.
     * f(-123.45) => “-123.45”。
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertNegativeAndFloatNumeric()
    {
        $this->assertEquals("-123.45", $this->numericFormat("-123.45"));
    }

    /**
     * Format a numeric with grouped thousands
     *
     * @param string $numeric The numeric being formatted.
     *
     * @return string A formatted version of numeric.
     */
    private function numericFormat(string $numeric)
    {
        $decimals = 0;
        if (preg_match("/\./i", $numeric)) {
            $decimals = strlen(explode(".", $numeric)[1]);
        }

        return number_format($numeric, $decimals);
    }

    /**
     * 請使用你/妳擅長的語言實作一個 next numeric function，給定一個整數，以同樣的數字組合找出下一個大於此整數的數字。
     * First case: Find next permutation greater numeric.
     * e.g.
     * f(123) => 132
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertNextPermutationGreaterNumeric()
    {
        $this->assertEquals("132", $this->nextGreaterNumeric("123"));
    }

    /**
     * Reorganize numeric and find next permutation greater numeric.
     *
     * @param string $numeric The numeric being reorganized.
     *
     * @return string Next greater numeric.
     */
    private function nextGreaterNumeric(string $numeric)
    {
        $numericSplitArray = str_split($numeric, 1);
        $baseKey = count($numericSplitArray) - 2;

        while ($baseKey >= 0 && $numericSplitArray[$baseKey + 1] <= $numericSplitArray[$baseKey]) {
            $baseKey--;
        }

        $swapKey = count($numericSplitArray) - 1;
        while ($swapKey > $baseKey && $numericSplitArray[$swapKey] <= $numericSplitArray[$baseKey]) {
            $swapKey--;
        }

        $temporaryVale = $numericSplitArray[$baseKey];
        $numericSplitArray[$baseKey] = $numericSplitArray[$swapKey];
        $numericSplitArray[$swapKey] = $temporaryVale;

        return implode($numericSplitArray);
    }
}
