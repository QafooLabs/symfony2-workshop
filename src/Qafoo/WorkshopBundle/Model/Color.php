<?php

namespace Qafoo\WorkshopBundle\Model;

class Color
{
    private $hex;

    public function __construct($hex)
    {
        $this->hex = $hex;
    }

    public function __toString()
    {
        return (string)$this->hex;
    }
}

