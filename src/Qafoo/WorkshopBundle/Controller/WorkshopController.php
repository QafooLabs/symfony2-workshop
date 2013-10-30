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
    public function helloWorldAction()
    {
        return $this->render('QafooWorkshopBundle:Workshop:helloWorld.html.twig', array());
    }

    /**
     * Building a Color Form Type
     */
    public function formAction(Request $request)
    {
        $savings = new Savings();
        $form = $this->createForm(new SavingsType(), $savings);

        if ($request->getMethod() === 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $session = $request->getSession();
                $session->getFlashBag()->add('notice', sprintf(
                    'You will have earned %s € after %d years of saving.', round($savings->calculate(), 2), $savings->years
                ));

                return $this->redirect($this->generateUrl('form'));
            }
        }

        return $this->render('QafooWorkshopBundle:Workshop:savings.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}


