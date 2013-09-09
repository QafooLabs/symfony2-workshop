<?php

namespace Qafoo\WorkshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Collections\Criteria;

use Qafoo\WorkshopBundle\Model\Player;
use Qafoo\WorkshopBundle\Form\PlayerType;

class WorkshopController extends Controller
{
    public function helloWorldAction()
    {
        return $this->render('QafooWorkshopBundle:Workshop:helloWorld.html.twig', array());
    }

    public function testAction(Request $request)
    {
        return new Response('Hello ' . $request->query->get('name', 'World!'));
    }

    /**
     * Building a Color Form Type
     */
    public function formAction(Request $request)
    {
        $player = new Player();
        $valid = false;

        $form = $this->createForm(new PlayerType(), $player);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $valid = true;
            }
        }

        return $this->render('QafooWorkshopBundle:Workshop:color.html.twig', array(
            'player' => $player,
            'valid' => $valid,
            'form' => $form->createView(),
        ));
    }
}


