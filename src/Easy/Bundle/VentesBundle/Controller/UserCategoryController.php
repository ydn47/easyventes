<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Easy\Bundle\VentesBundle\Entity\UserCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserCategoryController extends Controller
{
    public function updateAction(Request $request)
    {
        $id = $this->container->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:User');
        $repoPC = $em->getRepository('EasyVentesBundle:Product');
        $repoUC = $em->getRepository('EasyVentesBundle:UserCategory');
        
        $user = $repo->find($id);
        
        if (!$user) {
            throw new EntityNotFoundException("L'utilisateur n'existe pas en base de données");
        }
        
        $product = $repoPC->find($request->get('id'));
        $categories = $product->getCategories();
        
        foreach ($categories as $category) {
            $uc = $repoUC->findBy(array('user' => $user, 'category' => $category));
            if ($uc) {
                $uc[0]->setActive(1);
                $em->persist($uc[0]);
            } else {
                $uc = new UserCategory();
                $uc->setUser($user)
                   ->setCategory($category)
                   ->setActive(1);
                $em->persist($uc);
            }
            
            $em->flush();
        }
        
        $sess = $this->get('session');
        $fb = $sess->getFlashbag();
        $fb->add('success', "Vous serez averti dès que ".$product->getName()." sera mis en vente dans un event");

        return $this->redirect($this->generateUrl('easy_client_best'));
    }
}
