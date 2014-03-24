<?php

namespace Qafoo\WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Collections\Criteria;

use Qafoo\WorkshopBundle\Form\SavingsType;
use Qafoo\WorkshopBundle\Entity\Savings;

class WorkshopController extends Controller
{
    public function helloWorldAction(Request $request)
    {
        $name = $request->query->get('name', 'World');

        return $this->render('QafooWorkshopBundle:Workshop:helloWorld.html.twig', array(
            'name' => $name,
            'currentTime' => date('H:i'),
            'partOfDay' => $this->getPartOfDay(),
        ));
    }

    private function getPartOfDay()
    {
        if (date('H') > 4 && date('H') < 12) {
            $partDay = 'morning';
        } else if (date('H') >= 12 && date('H') < 19) {
            $partDay = 'afternoon';
        } else {
            $partDay = 'night';
        }

        return $partDay;
    }
}

