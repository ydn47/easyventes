<?php

namespace Easy\Bundle\ClientBundle\Controller;

use Easy\Bundle\ClientBundle\Form\Type\UserEventType;
use Easy\Bundle\VentesBundle\Entity\UserEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EventController
 * @package Easy\Bundle\ClientBundle\Controller
 */
class EventController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Event');
        $events = $repos->findAll();

        return $this->render('EasyClientBundle:Event:list.html.twig', ['events'=> $events]);
    }

    public function inscriptionAction(Request $request)
    {
        $form = $this->createForm(new UserEventType(), new UserEvent());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('easy_product_list'));
        }
        return $this->render('EasyClienBundle:Event:form.html.twig', ['form' => $form->createView()]);
    }
}
