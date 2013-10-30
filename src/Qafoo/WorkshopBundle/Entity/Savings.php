<?php

namespace Qafoo\WorkshopBundle\Entity;

class Savings
{
    public $money = 1000;
    public $interest = 2;
    public $years = 10;

    public function calculate()
    {
        return ($this->money * pow((100 + $this->interest) / 100, $this->years)) - $this->money;
    }
}
