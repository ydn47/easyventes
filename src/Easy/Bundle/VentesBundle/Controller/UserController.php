<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

class UserController extends Controller
{
    /**
     * @Secure(roles="IS_AUTHENTICATED_FULLY")
     */
    public function updateAction()
    {
        return $this->render('EasyVentesBundle:User:update.html.twig');
    }


    public function indexAction()
    {
        return $this->render('EasyVentesBundle:User:index.html.twig');
    }
}
