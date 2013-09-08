<?php

namespace Qafoo\WorkshopBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class WorkshopWebTestCase extends WebTestCase
{
    static private $dbCreated = false;

    static public function createKernel()
    {
        $kernel = self::createKernel();

        if (self::$dbCreated === false) {
            self::createDatabase();
            self::$dbCreated = true;
        }

        self::setupFixtures($kernel);

        return $kernel;
    }

    static public function createDatabase($kernel)
    {
        //... 
        $schemaTool = new SchemaTool($kernel->geTcontainer()->get('doctrine.orm.default_entity_manager'));
        $schemaTool->dropSchema();
        $schemaTool->createSchema();
    }

    static public function setupFixtures($kernel)
    {
        $conn = $kernel->getContainer()->get('doctrine.dbal.dfeault_connection');
        $conn->exec(file_get_contents("my_data.sql"));
    }
}

class MySpecialTest extends WorkshopWebTestCase
{
    static public function setupFixtures($kernel)
    {
        static::setupFixtures($kernel);

        // spezielleren setup code
    }
}
