<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Easy\Bundle\VentesBundle\Form\Type\UserType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Secure(roles="IS_AUTHENTICATED_FULLY")
     */
    public function updateAction(Request $request)
    {
        $id = $this->container->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:User');
        
        $user = $repo->find($id);
        
        if (!$user) {
            throw new EntityNotFoundException('L\'utilisateur n\'existe pas en base de données');
        }
        
        $userType = new UserType();
        $form = $this->createForm($userType, $user);
        $form->handleRequest($request);
        
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sess = $this->get('session');
            $fb = $sess->getFlashbag();
            
            $mail = $repo->findBy(
                array('email' => $_POST['user_form']['email'])
              );
            
            $pseudo = $repo->findBy(
                array('username' => $_POST['user_form']['username'])
              );

            $valid = true;
            if ($mail){
                if ($mail[0]->getId() != $id) {
                    $fb->add('alert', "Cet email existe déja");
                    $valid = false;
                }
            }
            
            if ($pseudo) {
                if ($pseudo[0]->getId() != $id) {
                    $fb->add('alert', "Ce pseudo existe déjà");
                    $valid = false;
                }
            }
            
            if ($valid) {
                $em->persist($form->getData());
                $em->flush();
                $fb->add('succes', "Modification effectuée");
            }
            
            return $this->redirect($this->generateUrl("easy_client_update"));
        }
        
        return $this->render('EasyVentesBundle:User:update.html.twig', array('form' => $form->createView()));
    }


    public function indexAction()
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->redirect($this->generateUrl('easy_event_list'));
        }
        return $this->render('EasyVentesBundle:User:index.html.twig');
    }
}
