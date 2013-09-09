<?php

namespace Qafoo\WorkshopBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloWorldPage
{
    private $client;
    private $crawler;

    public function __construct($c)
    {
        $this->client = $c;
    }

    public function visit()
    {
        $this->crawler = $this->client->request('GET', '/helloworld');
    }

    public function assertHellPageShown()
    {
        \PHPUnit_Framework_Assert::assertContains(
            'Hello world!',
            $this->client->getResponse()->getContent(),
            $this->crawler->filter('body')->text()
        );
    }
}

class FrontpPage
{
    public function __construct($c)
    {
        $this->client = $c;
    }

    public function goToHelloWorldPage()
    {
        $page = new HelloWOrldPage($this->client);
        $page->visit();
        return $page;
    }
}

class ControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createclient();
        $page = new HelloWOrldPage($client);
        $page->visit();
        $page->assertHellPageShown();
    }

    public function test404()
    {
        $client = static::createclient();
        $crawler = $client->request('GET', '/foobar');

        return;
        $this->failIfSymfonyError($crawler);

        var_dump(trim($crawler->filter('h1')->text()));
    }

    public function testWithProfiler()
    {
        $client = static::createclient();

        $crawler = $client->request('GET', '/');

        $profile = $client->getProfile();

        $this->assertEquals(0, count($profile->getCollector('db')->getQueries()['default']));
    }

    private function failIfSymfonyError($crawler)
    {
        if ($crawler->filter('.sf-exceptionreset')->count() > 0) {
            $message = trim($crawler->filter('h1')->text());
            throw new \RuntimeException($message);
        }
    }
}
