<?php

namespace Easy\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package Easy\Bundle\VentesBundle\Controller
 */
class ProductController extends Controller
{
    public function listAction(Request $request)
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->redirect($this->generateUrl('easy_product_list'));
        }
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Product');
        $products = $repos->findAll();

        $pagination = $this->get('knp_paginator')
            ->paginate($products, $request->query->get('page', 1), 10);

        return $this->render('EasyClientBundle:Product:list.html.twig', ['pagination'=> $pagination]);
    }

}