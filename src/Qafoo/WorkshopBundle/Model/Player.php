<?php

namespace Qafoo\WorkshopBundle\Model;

use Symfony\Component\Validator\Constraints
    as Assert;

class Player
{
    /**
     * @Assert\NotBlank
     */
    protected $name;
    protected $color;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }
}
