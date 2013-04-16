<?php

namespace Qafoo\WorkshopBundle\Model;

class Color
{
    private $hex;

    public function setHex($hex)
    {
        $this->hex = $hex;
    }

    public function getHex()
    {
        return $this->hex;
    }

    public function __toString()
    {
        return (string)$this->hex;
    }
}

