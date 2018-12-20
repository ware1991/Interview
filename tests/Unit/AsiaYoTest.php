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
     * Format a numeric with grouped thousands
     *
     * @param string $numeric The numeric being formatted.
     *
     * @return string A formatted version of numeric.
     */
    private function numericFormat(string $numeric)
    {
        return number_format($numeric);
    }
}
