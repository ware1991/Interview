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
     * -
     * 解題思維：1. 從右至左，找到左邊數字大於右邊數字的鍵位
     *          2. 再從右邊比對一次，將數字大於第一次比對出來的數字做交換
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertNextPermutationGreaterNumeric()
    {
        $this->assertEquals("132", $this->nextGreaterNumeric("123"));
    }

    /**
     * 請使用你/妳擅長的語言實作一個 next numeric function，給定一個整數，以同樣的數字組合找出下一個大於此整數的數字。
     * Second case: Find next permutation greater numeric has the same number.
     * e.g.
     * f(5566) => 5656
     * -
     * 解題思維：1. 第一個案列交換後的數列，若是出現位數較多的數列，會出現交換後的數列並非下一個最大
     *          2. 被交換後的數列，從 $baseKey 往右開始的數列可能為降冪排列的數列
     *          3. 將 $baseKey 往右開始的降冪數列，反轉一次即可為升冪排列的數列
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertNextPermutationGreaterNumericHasSameNumber()
    {
        $this->assertEquals("5656", $this->nextGreaterNumeric("5566"));
    }

    /**
     * 請使用你/妳擅長的語言實作一個 next numeric function，給定一個整數，以同樣的數字組合找出下一個大於此整數的數字。
     * Third case: Find next permutation greater negative numeric.
     * e.g.
     * f(-3310) => f(-3301)
     * -
     * 解題思維：1. 負數為數值越小數列越大，與正數邏輯相反
     *          2. 從右至左，找到左邊數字小於右邊數字的鍵位
     *          3. 再從右邊比對一次，數字大於第一次結果的數字就交換
     *          4. 負整數會有負號，所以拆分後的陣列需要避開負號的鍵位
     *
     * @test
     * @group AsiaYoTest
     */
    public function assertNextPermutationGreaterNegativeNumeric()
    {
        $this->assertEquals("-3301", $this->nextGreaterNegativeNumeric("-3310"));
    }

    /**
     * Reorganize numeric and find next permutation greater numeric.
     *
     * @param string $numeric The numeric being reorganized.
     *
     * @return string Next greater numeric.
     */
    private function nextGreaterNumeric(string $numeric): string
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

        $numericSplitArray = $this->swapNumeric($numericSplitArray, $baseKey, $swapKey);

        $numericSplitArray = $this->reverseNumeric($numericSplitArray, $baseKey + 1);

        return implode($numericSplitArray);
    }

    /**
     * Reorganize numeric and find next permutation greater negative numeric.
     *
     * @param string $numeric The numeric being reorganized.
     *
     * @return string Next greater negative numeric.
     */
    private function nextGreaterNegativeNumeric(string $numeric): string
    {
        $numericSplitArray = str_split($numeric, 1);

        $baseKey = count($numericSplitArray) - 2;
        while ($baseKey > 1 && $numericSplitArray[$baseKey + 1] >= $numericSplitArray[$baseKey]) {
            $baseKey--;
        }

        $swapKey = count($numericSplitArray) - 1;
        while ($swapKey > $baseKey && $numericSplitArray[$swapKey] >= $numericSplitArray[$baseKey]) {
            $swapKey--;
        }

        $numericSplitArray = $this->swapNumeric($numericSplitArray, $baseKey, $swapKey);

        return implode($numericSplitArray);
    }

    /**
     * Swap the array value by key.
     *
     * @param array $numericArray The numeric array being swapped.
     * @param int   $baseKey      This key will be swapped by $swapKey.
     * @param int   $swapKey      This key for swapped.
     *
     * @return array A swapped version of numeric array.
     */
    private function swapNumeric(Array $numericArray, int $baseKey, int $swapKey): array
    {
        $temporaryVale = $numericArray[$baseKey];
        $numericArray[$baseKey] = $numericArray[$swapKey];
        $numericArray[$swapKey] = $temporaryVale;

        return $numericArray;
    }

    /**
     * Reverse the array value from $startKey.
     *
     * @param array $numericArray The numeric array being reversed.
     * @param int   $startKey     This key is the reverse base key.
     *
     * @return array A reverse version of numeric array.
     */
    private function reverseNumeric(Array $numericArray, int $startKey): array
    {
        $swapKey = count($numericArray) - 1;
        while ($startKey < $swapKey && $numericArray[$startKey] >= $numericArray[$swapKey]) {
            $numericArray = $this->swapNumeric($numericArray, $startKey, $swapKey);

            $startKey++;
            $swapKey--;
        }

        return $numericArray;
    }
}