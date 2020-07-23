<?php

declare(strict_types=1);

require_once($_SERVER['DOCUMENT_ROOT'] . 'vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use stack\Stack;

final class StackSimpleTest extends TestCase
{
    public function testAfterCreationStackIsEmpty()
    {
        $stack = new Stack;
        $this->assertSame(0, count($stack));
    }

    public function testAfterPushStackIsNotEmpty()
    {
        $stack = new Stack;
        $stack->push("Item");
        $this->assertNotEquals(0, count($stack));
        $stack->pop();
    }


    public function testCannotPopFromEmptyStack()
    {
        $stack = new Stack;
        $this->expectExceptionMessage("Stack is empty");
        $stack->pop();
    }

    public function testCannotPopFromEmptyStackAfterPush()
    {
        $stack = new Stack;
        $items = ["item1", "item2", "item3", "item4", "item5"];
        foreach ($items as $item)
        {
            $stack->push($item);
        }
        $pops = count($items) + 1;
        
        $this->expectExceptionMessage("Stack is empty");
        for ($i=0; $i<$pops; $i++)
        {
            $stack->pop();
        }
    }

    public function testAfterPushToEmptyStackNumberOfElementsEqualsOne()
    {
        $stack = new Stack;
        $stack->push("item");
        $this->assertSame(1, count($stack));
    }

    public function testStackIsEmptyAfterPop()
    {
        $stack = new Stack;
        $stack->push("item");
        $stack->pop();
        $this->assertSame(0, count($stack));
    }

    public function testInsertMultipleElements()
    {
        $stack = new Stack;
        $items = ["item1", "item2", "item3", "item4", "item5"];
        foreach ($items as $item)
        {
            $stack->push($item);
        }
        $this->assertSame(count($items), count($stack));
    }

    public function testPopReturnsLastInsertedElement()
    {
        $stack = new Stack;
        $items = ["item1", "item2", "item3", "item4", "item5"];
        foreach ($items as $item)
        {
            $stack->push($item);
        }
        $this->assertSame(end($items), $stack->pop());
    }
    
    public function testPopReturnsPushedElementsInOrder()
    {
        $stack = new Stack;
        $items = ["item1", "item2", "item3", "item4", "item5"];
        foreach ($items as $item)
        {
            $stack->push($item);
        }
        foreach (array_reverse($items) as $item)
        {
            $this->assertSame($item, $stack->pop());
        }
    }

    public function testPopPushPopReturnsPushedElement()
    {
        $stack = new Stack;
        $stack->push("Item1");
        $stack->pop();
        $stack->push("Item2");
        $this->assertEquals(1, count($stack));
        $this->assertEquals("Item2", $stack->pop());
    }
}

?>