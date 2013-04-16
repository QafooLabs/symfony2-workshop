<?php

namespace Qafoo\WorkshopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // See http://api.symfony.com/2.2/Symfony/Component/Form/FormBuilder.html
        //
        // Try with:
        // 1. addEventListener()
        // 2. addViewTransformer()
        //
        // See DateTimeType
        $builder
            ->add('r', 'number')
            ->add('g', 'number')
            ->add('b', 'number')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qafoo\WorkshopBundle\Model\Color',
        ));
    }

    public function getName()
    {
        return 'color';
    }
}

