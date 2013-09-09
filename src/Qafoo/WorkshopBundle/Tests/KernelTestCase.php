<?php
namespace Qafoo\WorkshopBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class KernelTestCase extends WebTestCase
{
    protected $container;

    public function setUp()
    {
        $config = array('environment'=>'test', 'debug'=>true);
        self::$kernel = self::createKernel($config);
        self::$kernel->boot();

        $this->container = self::$kernel->getContainer();
    }

    public function tearDown()
    {
        if (self::$kernel === null) {
            return;
        }

        self::$kernel->shutdown();
    }
}
