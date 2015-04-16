<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EasyVentesBundle:User:back.html.twig');
    }
}
