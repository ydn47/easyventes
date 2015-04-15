<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Easy\Bundle\VentesBundle\Entity\Event;
use Easy\Bundle\VentesBundle\Form\Type\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Event');
        $events = $repos->findAll();
        return $this->render('EasyVentesBundle:Event:list.html.twig', ['events'=> $events]);
    }

    public function detailAction($id)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('EasyVentesBundle:Event');
        $event = $repo->find($id);

        return $this->render('EasyVentesBundle:Event:detail.html.twig', ['event' => $event]);
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(new EventType(), new Event());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('easy_event_list'));
        }
        return $this->render('EasyVentesBundle:Event:form.html.twig', ['form' => $form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('EasyVentesBundle:Event');
        $event = $repo->find($id);

        $form = $this->createForm(new EventType(),$event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('easy_event_list'));
        }
        return $this->render('EasyVentesBundle:Event:form.html.twig', ['form' => $form->createView()]);
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:Event');
        $product= $repo->find($id);
        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl("easy_event_list"));
    }

}