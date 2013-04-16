<?php

namespace Qafoo\WorkshopBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;

class ColorTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        return $value;
    }
}
