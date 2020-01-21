<?php
// paradam.me.loc/StackTest.php
	namespace app\tests\unit;
	
	
	

	
	use PHPUnit\Framework\TestCase;
	
	/**
	 * Class StackTest
	 * @package app\tests\unit
	 * @var TestCase $this
	 */
	class StackTest extends TestCase
	{
		public function testEmpty(): array
		{
			$stack = [];
			$this->assertEmpty($stack);
			return $stack;
		}
		
		/**
		 * @depends testEmpty
		 * @param array $stack
		 * @return array
		 */
		public function testPush(array $stack): array
		{
			$stack[] = 'foo';
			$this->assertSame('foo', $stack[count($stack) - 1]);
			$this->assertNotEmpty($stack);
			
			return $stack;
		}
		
		/**
		 * @depends testPush
		 * @param array $stack
		 */
		public function testPop(array $stack): void
		{
			$this->assertSame('foo', array_pop($stack));
			$this->assertEmpty($stack);
		}
		
		public function testPushAndPop(): void
		{
			$stack = [];
			$this->assertCount(0, $stack);
			
			$stack[] = 'foo';
			$this->assertSame('foo', $stack[count($stack) - 1]);
			$this->assertCount(1, $stack);
			
			$this->assertSame('foo', array_pop($stack));
			$this->assertCount(0, $stack);
		}
		
	}
