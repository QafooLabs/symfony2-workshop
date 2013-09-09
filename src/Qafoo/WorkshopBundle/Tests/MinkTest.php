<?php

namespace Qafoo\WorkshopBundle\Tests;

class MinkTest extends \PHPUnit_Framework_TestCase
{
    public function testWikipediaFrontpage()
    {
        $session = $this->createSession($this->createGuzzleDriver());
        $session = $this->createSession($this->createSahiDriver());
        $session->visit('http://wikipedia.org');

        $session->evaluateScript('console.log("foo");');

        $this->assertContains('de.wikipedia.org', $session->getPage()->getContent());

        $crawler = $this->getCrawlerForCurrentPage($session);
        #echo $crawler->text();
    }

    private function getCrawlerForCurrentPage($session)
    {
        return new \Symfony\Component\DomCrawler\Crawler($session->getPage()->getContent());
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
        $driver->setBasicAuth('foo', 'bar');

        return $driver;
    }

    private function createSahiDriver()
    {
        $driver = new \Behat\Mink\Driver\SahiDriver('chrome');

        return $driver;
    }

    public function testMinkClient()
    {
        $session = $this->createSession($this->createGuzzleDriver());
        $client = new MinkClient($session, 'http://wikipedia.org');
        $client->request('GET', '/foobar');

        echo $client->getResponse()->getContent();
    }
}
