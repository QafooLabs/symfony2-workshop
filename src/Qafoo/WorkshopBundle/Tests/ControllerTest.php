<?php

namespace Qafoo\WorkshopBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group functional
 */
class ControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $client->getResponse()->getContent();

        $linkText = $crawler->filter('a[href="/helloworld"]')->text();
        // $crawler->filter('#id') or $crawler->filter('.class')
        return;
        $this->assertEquals('helloworld', $linkText);

        $link = $crawler->selectLink('helloworld')->link();
        $client->click($link);

        $form = $crawler->selectButton('someform')->form();
        $client->submit($form, array('foo' => 'bar'));
    }

    public function testSubmitForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/form');

var_dump($client->getResponse()->getContent());
        $form = $crawler->selectButton('Save')->form();
        var_dump($form);
    }
}
