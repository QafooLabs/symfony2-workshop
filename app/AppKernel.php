<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
            new Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
            new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),
            new Qafoo\WorkshopBundle\QafooWorkshopBundle(),

            //new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            //new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }
}

