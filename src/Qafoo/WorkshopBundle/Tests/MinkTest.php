<?php

namespace Qafoo\WorkshopBundle\Tests;

class MinkTest extends \PHPUnit_Framework_TestCase
{
    public function testWikipediaFrontpage()
    {
        $session = $this->createSession($this->createGuzzleDriver());
        $session = $this->createSession($this->createSahiDriver());
        $session->visit('http://wikipedia.org');

        echo $session->getPage()->getContent();
    }

    private function createSession($driver)
    {
        $session = new \Behat\Mink\Session($driver);
        $session->start();

        return $session;
    }

    private function createGuzzleDriver()
    {
        $clientOptions = array();

        $client = new \Behat\Mink\Driver\Goutte\Client();
        $client->setClient(new \Guzzle\Http\Client('', $clientOptions));
        $driver = new \Behat\Mink\Driver\GoutteDriver($client);

        return $driver;
    }

    private function createSahiDriver()
    {
        $driver = new \Behat\Mink\Driver\SahiDriver('firefox');

        return $driver;
    }
}
