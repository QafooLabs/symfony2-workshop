<?php

namespace Qafoo\WorkshopBundle\Form;

use Qafoo\WorkshopBundle\Model\Color;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // See http://api.symfony.com/2.2/Symfony/Component/Form/FormBuilder.html
        //
        // 1. addModelTransformer()
        // 2. addViewTransformer()
        //
        // See DateTimeType
        $builder
            ->addModelTransformer(new ColorTransformer())
            ->addViewTransformer(new ColorTransformer())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array());
    }

    public function getName()
    {
        return 'color';
    }
}

