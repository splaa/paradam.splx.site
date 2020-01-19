<?php
// paradam.me.loc/StackTest.php
	namespace app\tests\unit;
	
	
	use PHPUnit\Framework\TestCase;
	
	class StackTest extends TestCase
	{
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
