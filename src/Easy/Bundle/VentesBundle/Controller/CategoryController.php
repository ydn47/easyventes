<?php

namespace Easy\Bundle\VentesBundle\Controller;


use Easy\Bundle\VentesBundle\Entity\Category;
use Easy\Bundle\VentesBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Category');
        $categories = $repos->findAll();
        return $this->render('EasyVentesBundle:Category:list.html.twig', ['categories'=> $categories]);
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(new CategoryType(), new Category());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('easy_category_list'));
        }
        return $this->render('EasyVentesBundle:Category:form.html.twig', ['form' => $form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('EasyVentesBundle:Category');
        $category = $repo->find($id);

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('easy_category_list'));
        }
        return $this->render('EasyVentesBundle:Category:form.html.twig', ['form' => $form->createView()]);
    }

}