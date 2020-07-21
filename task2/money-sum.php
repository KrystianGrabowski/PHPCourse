<?php 

class Money 
{
    private $currency;
    private $amount;

    function __construct($amount, $currency)
    {
        if ($amount < 0) 
        {
            throw new Exception("Amount cannot be negative");
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    // Getters, setters
    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($newCurrency)
    {
        $this->currency = $newCurrency;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($newAmount)
    {
        $this->amount = $newAmount;
    }

    // Arithmetical operations
    public function add(Money $money)
    {
        if ($this->currency != $money->currency) 
        {
            throw new Exception("Different currency. Cannot perform operation!");
        }
        $this->setAmount($this->getAmount() + $money->getAmount());
    }
    
    public function sub(Money $money)
    {
        if ($this->currency != $money->currency) 
        {
            throw new Exception("Different currency. Cannot perform operation!");
        }
        if ($money->getAmount() > $this->getAmount()) 
        {
            throw new Exception("Amount cannot be negative");
        }
        $this->setAmount($this->getAmount() - $money->getAmount());
    }

    public function mult(int $number) 
    {
        if ($number < 0) 
        {
            throw new Exception("Amount cannot be multiplied by negative value!");
        }
        $this->setAmount($this->getAmount() * $number);
    }

    public function div(int $number) 
    {
        if ($number <= 0) 
        {
            throw new Exception("Amount cannot be divided by zero or negative value!");
        }
        $this->setAmount(round($this->getAmount() / $number, 2, PHP_ROUND_HALF_DOWN));
    }
}

interface MoneyFormatter 
{
    public function toString();
}

class myFormatter implements MoneyFormatter 
{
    private $comma;
    private $separator;
    private $whole;
    private $fraction;
    private $money;
    

    function __construct(Money $money, $separator, $comma)
    {
        $wholePart = floor($money->getAmount());
        $this->money = $money;
        $this->whole = $wholePart;
        $this->fraction = intval(($money->getAmount() - $wholePart) * 100);
        $this->separator = $separator;
        $this->comma = $comma;
        
    }

    function toString()
    {
        $wholeStr = str_split($this->whole);
        $fractionStr = str_split($this->fraction);
        $reminder = count($wholeStr) % 3;
        $numOfIter = intval(count($wholeStr) / 3);
        $str = "";
        for ($i = 0; $i < $reminder; $i++) 
        {
            $str .= $wholeStr[0];
            array_shift($wholeStr);
        }
        if ($numOfIter != 0 && $reminder != 0) 
        {
            $str .= $this->separator;
        }
        for ($i = 0; $i < $numOfIter; $i++) 
        {
            for ($j = 0; $j < 3; $j++) 
            {
                $str .= $wholeStr[$i * 3 + $j];
            }
            if ($i != $numOfIter - 1) 
            {
                $str .= $this->separator;
            }
        }
        $str .= $this->comma;
        foreach ($fractionStr as $digit) 
        {
            $str .= $digit;
        }
        $str .= " " . $this->money->getCurrency();
        return $str;
    }
}

if ($argc > 1) 
{

    $currency = $argv[1];
    $money = new Money(0, $currency);

    foreach ($argv as $i => $amount)
    {
        if ($i > 1)
        {
            $newMoney = new Money($amount, $currency);
            $money->add($newMoney);
        }
    }

    $formatter = new myFormatter($money, " ", ",");
    echo $formatter->toString();
}

try
{
    $m = new Money(22, 'USD');
    $m->div(0);
}
catch (Exception $e)
{
    echo $e->getMessage();
}



?>