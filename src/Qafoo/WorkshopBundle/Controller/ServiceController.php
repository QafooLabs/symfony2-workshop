<?php

namespace Qafoo\WorkshopBundle\Controller;

use QafooLabs\Bundle\FrameworkExtraBundle\Controller\ControllerUtils;
use Symfony\Component\HttpFoundation\Request;

class ServiceController
{
    private $utils;

    public function __construct(ControllerUtils $utils)
    {
        $this->utils = $utils;
    }

    public function helloAction(Request $request)
    {
        return array(
            'name' => $request->query->get('name', 'World')
        );
    }
}
