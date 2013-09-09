<?php

namespace Qafoo\WorkshopBundle\Tests;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\DomCrawler\Form;

class MinkClient extends Client
{
    private $minkSession;
    private $baseUrl;

    public function __construct($minkSession, $baseUrl)
    {
        $this->minkSession = $minkSession;
        $this->baseUrl = $baseUrl;
        parent::__construct();
    }

    protected function doRequest($request)
    {
        $this->minkSession->visit($this->baseUrl . $request->getUri());

        if ($request->getMethod() === 'POST') {
            foreach ($request->getParameters() as $field => $value) {
                $this->minkSession->getPage()->fillField($field, $value);
            }
        }

        return new Response(
            $this->minkSession->getPage()->getContent(),
            $this->minkSession->getStatusCode(),
            $this->minkSession->getResponseHeaders()
        );
    }

    public function click(Link $link)
    {
        if ($link instanceof Form) {
            return $this->submit($link);
        }

        return $this->request($link->getMethod(), $link->getUri());
    }

    public function submit(Form $form, array $values = array())
    {
        $form->setValues($values);

        return $this->request($form->getMethod(), $form->getUri(), $form->getPhpValues(), $form->getPhpFiles());
    }
}
