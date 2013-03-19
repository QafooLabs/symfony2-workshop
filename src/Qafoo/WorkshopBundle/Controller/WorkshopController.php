<?php

namespace Qafoo\WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Collections\Criteria;

class WorkshopController extends Controller
{
    public function indexAction()
    {
        return $this->render('QafooWorkshopBundle:Workshop:index.html.twig', array());
    }
}


