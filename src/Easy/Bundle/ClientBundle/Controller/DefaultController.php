<?php

namespace Easy\Bundle\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EasyClientBundle:Default:index.html.twig', array('name' => $name));
    }
}
