<?php

namespace stack;

use Countable;
use Exception;

class Stack implements Countable
{
    private $stack;

    function __construct()
    {
        $this->stack = [];
    }
    
    public function getStack()
    {
        return $this->stack;
    }

    public function count()
    {
        return count($this->stack);
    }

    public function push($item)
    {
        $this->stack[] = $item;
    }

    public function pop()
    {
        if ($this->empty())
        {
            throw new Exception("Stack is empty");
        }
        return array_pop($this->stack);
    }

    public function empty()
    {
        return empty($this->stack);
    }
}

?>