<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/MathUtils.php';

class MathUtilsTest extends TestCase
{
    private MathUtils $math;

    protected function setUp(): void
    {
        $this->math = new MathUtils();
    }

    public function testAdd(): void
    {
        $this->assertEquals(5.0, $this->math->add(2, 3));
        $this->assertEquals(0.0, $this->math->add(-1, 1));
    }

    public function testSubtract(): void
    {
        $this->assertEquals(1.0, $this->math->subtract(3, 2));
        $this->assertEquals(-4.0, $this->math->subtract(1, 5));
    }

    public function testMultiply(): void
    {
        $this->assertEquals(6.0, $this->math->multiply(2, 3));
        $this->assertEquals(0.0, $this->math->multiply(0, 99));
    }

    public function testDivide(): void
    {
        $this->assertEquals(2.0, $this->math->divide(6, 3));
    }

    public function testDivideByZeroThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->math->divide(10, 0);
    }

    public function testMax(): void
    {
        $this->assertEquals(9.0, $this->math->max(4, 9));
        $this->assertEquals(5.0, $this->math->max(5, 5));
    }

    public function testFactorial(): void
    {
        $this->assertEquals(1, $this->math->factorial(0));
        $this->assertEquals(1, $this->math->factorial(1));
        $this->assertEquals(120, $this->math->factorial(5));
    }

    public function testFactorialNegativeThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->math->factorial(-1);
    }
}
