<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EasyVentesBundle:Default:index.html.twig', array('name' => $name));
    }
}
