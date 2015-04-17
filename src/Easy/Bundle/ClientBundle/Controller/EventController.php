<?php

namespace Easy\Bundle\ClientBundle\Controller;

use Easy\Bundle\VentesBundle\Entity\User;
use Easy\Bundle\VentesBundle\Entity\UserEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EventController
 * @package Easy\Bundle\ClientBundle\Controller
 */
class EventController extends Controller
{
    public function listAction(Request $request)
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->redirect($this->generateUrl('easy_event_list'));
        }
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Event');
        $events = $repos->findEventInProgress();
        $pagination = $this->get('knp_paginator')
            ->paginate($events, $request->query->get('page', 1), 10);

        return $this->render('EasyClientBundle:Event:list.html.twig', ['pagination'=> $pagination]);
    }

    public function listUserAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Event');
        $events = $repos->findEventInProgress();

        $pagination = $this->get('knp_paginator')
            ->paginate($events, $request->query->get('page', 1), 10);

        return $this->render('EasyClientBundle:Event:list.html.twig', ['pagination'=> $pagination]);
    }

    public function detailAction($id){
        $manager = $this->getDoctrine()->getManager();

        $repo = $manager->getRepository('EasyVentesBundle:Event');
        $event = $repo->find($id);

        $user = $this->container->get('security.context')->getToken()->getUser();
        $userEvent = $manager->getRepository('EasyVentesBundle:UserEvent')
            ->findOneBy(
                array('user' => $user, 'event' => $event)
            );

        $state = null;
        if( $userEvent ){
            $state = $userEvent->getState();
        }

        $categories = $event->getCategories();
        $repoP = $manager->getRepository('EasyVentesBundle:Product');
        $products = array();
        foreach ($categories as $category) {
            $productsType = $repoP->findProductsType($category->getId());
            foreach ($productsType as $product) {
                $p = $repoP->find($product->getId());
                if ($p->getActive() && !in_array($p , $products)) {
                    $products[] = $p;
                }
            }
        }
        return $this->render('EasyClientBundle:Event:detail.html.twig', ['event' => $event, 'state' => $state, 'products' => $products]);
    }

    public function inscriptionAction($id)
    {
        $manager = $this->getDoctrine()->getManager();

        $repo = $manager->getRepository('EasyVentesBundle:Event');
        $event = $repo->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();

        $userEvent = $manager->getRepository('EasyVentesBundle:UserEvent')
            ->findBy(array('user' => $user, 'event' => $event)
            );

        if (! $userEvent){
            $userEvent = new UserEvent();
            $userEvent
                ->setEvent($event)
                ->setUser($user)
                ->setDate(new \DateTime())
                ->setState('DEM');

            $em = $this->getDoctrine()->getManager();
            $em->persist($userEvent);
            $em->flush();

            $this->sendMailAction($user);

            $this->get('session')->getFlashBag()->add('success', 'Votre demande de participation à été enregistré');
        } else {
            $this->get('session')->getFlashBag()->add('info', 'Votre demande à déjà été enregistré');
        }

        return $this->redirect($this->generateUrl('easy_client_event'));
    }

    public function eventUserAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $events = $user->getEvents();

        return $this->render('EasyClientBundle:Event:list.html.twig', ['events' => $events]);
    }

    public function sendMailAction(User $user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Demande de Participation')
            ->setFrom('send@example.com')
            ->setTo($user->getEmail())
            ->setBody($this->renderView('EasyClientBundle:Mailer:demandeParticipation.txt.twig'))
        ;
        $this->get('mailer')->send($message);


        /*
         *  ->setBody($this->renderView('...:....html.twig'), 'text/html')
         */
    }
}
