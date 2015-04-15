<?php

namespace Easy\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductController
 * @package Easy\Bundle\VentesBundle\Controller
 */
class ProductController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Product');
        $products = $repos->findAll();
        return $this->render('EasyClientBundle:Product:list.html.twig', ['products'=> $products]);
    }

}