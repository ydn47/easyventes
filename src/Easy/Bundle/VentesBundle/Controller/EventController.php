<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Easy\Bundle\VentesBundle\Entity\Event;
use Easy\Bundle\VentesBundle\Form\Type\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class EventController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Event');
        $events = $repos->findAll();
        $pagination = $this->get('knp_paginator')
            ->paginate($events, $request->query->get('page', 1), 10);

        return $this->render('EasyVentesBundle:Event:list.html.twig', ['pagination'=> $pagination]);
    }

    public function detailAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('EasyVentesBundle:Event');
        $event = $repo->find($id);

        $categories = $event->getCategories();
        $repoP = $manager->getRepository('EasyVentesBundle:Product');
        $products = [];
        foreach ($categories as $category) {
            $productsType = $repoP->findProductsType($category->getId());
            foreach ($productsType as $product) {
                $p = $repoP->find($product->getId());
                if ($p->getActive() && !in_array($p , $products)) {
                    $products[] = $p;
                }
            }
        }

        // validation loterie
        $repo = $manager->getRepository('EasyVentesBundle:UserEvent');
        $userevents = $repo->findBy( array('event' => $event, 'state' => 'DEM'));

        $loterie = false;
        $addProduct = false;

        if ($userevents){
            if ( $event->getDateStart()->format("Y-m-d H:i:s") > date("Y-m-d H:i:s")){
                $loterie = true;
            }
        }

        // validation loterie and added product
        if ($event->getDateEnd()->format("Y-m-d H:i:s") < date("Y-m-d H:i:s")){
            $addProduct = true;
        }

        return $this->render('EasyVentesBundle:Event:detail.html.twig', [
            'event' => $event,
            'products' => $products,
            'loterie' => $loterie,
            'addProduct' => $addProduct
        ]);
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(new EventType(), new Event());
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

             $this->sendMailAction($form->getData());

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

    public function sendMailAction(Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:User')
                    ;
        $users = $repos->findAll();
        $categoriesEvent = $event->getCategories();
//        return new Response($categoriesEvent->getName());
        $dispo = "false";
        foreach($users as $user){
        $message = \Swift_Message::newInstance()
                ->setSubject('Le produit que vous avez demandé est disponible')
                ->setFrom(array('send@example.com' => "Société easyVentes"))
                ->setTo($user->getEmail())
                ->setBody($this->renderView('EasyClientBundle:Mailer:newEvent.html.twig'), 'text/html');
                $this->get('mailer')->send($message);
        }
//        $categoriesEventArray[] = $categoriesEvent;
//        foreach($users as $user){
//        $categoriesUser = $user->getCategories();
//        
//            foreach ($categoriesUser as $categorieUser) {
//                var_dump($categorieUser); die();
//            if(in_array($categorieUser, $categoriesEventArray)) {
//                    $dispo = "true";
//                }
//            }
//            return new Response($dispo);
//            if($dispo) {
//                $message = \Swift_Message::newInstance()
//                ->setSubject('Demande de Participation')
//                ->setFrom('send@example.com')
//                ->setTo($user->getEmail())
//                ->setBody($this->renderView('EasyClientBundle:Mailer:demandeParticipation.html.twig'), 'text/html');
//                $this->get('mailer')->send($message);
//            }
//            
//        }
    }

    public function loterieAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('EasyVentesBundle:Event');
        $repos = $manager->getRepository('EasyVentesBundle:User');
        $repository = $manager->getRepository('EasyVentesBundle:UserEvent');

        $event = $repo->find($id);
        $users = $repos->findUserLoterie($event);

        
        foreach ($users as $user){

            $userevent = $repository->findOneBy(array('user' => $user, 'event' => $event));
            $userevent->setState('VAL');
            $user->setNbEvent( $user->getNbEvent() + 1 );

            $manager->persist($user);
            $message = \Swift_Message::newInstance()
                    ->setSubject("Merci d'avoir  participer à un événement")
                    ->setFrom(array('yamgoue.daniella@gmail.com' => "Société easyVentes"))
                    ->setTo($user->getEmail())
                    ->setContentType("text/html")
                    ->setBody(
                        $this->renderView(
                            'EasyClientBundle:Mailer:thanks.html.twig', array("productSalesEvent" => $productSalesEvent))
                        )
//                ->setBody("merci d'avoir participé")
                    ;
                $this->get('mailer')->send($message);
            $manager->persist($userevent);
            $manager->flush();

            $this->get('session')->getFlashBag()->add('success', 'Votre loterie à bien été effectué');
        }

        $userevents = $repository->findBy( array('event' => $event, 'state' => 'DEM'));
        foreach ($userevents as $userevent){
            $userevent->setState('REF');
            $manager->persist($userevent);
            $manager->flush();
        }

        return $this->redirect($this->generateUrl("easy_event_list"));
    }

    public function exportAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:Event');
        $events = $repo->findAll();
        $lignes[] = array('Nom', 'Description');

        foreach($events as $event) {
            $lignes[] = array($event->getName(), $event->getDescription());
        }

        $chemin = 'listeEvents.csv';
        $delimiteur = ';';


        $fichier_csv = fopen($chemin, 'w+');

        fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

        foreach($lignes as $ligne){
            fputcsv($fichier_csv, $ligne, $delimiteur);
        }

        fclose($fichier_csv);


        $response = new Response();
        $response->setContent(file_get_contents($chemin));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $chemin);

        return $response;
    }
}
