<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Easy\Bundle\VentesBundle\Entity\Product;
use Easy\Bundle\VentesBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repos = $em->getRepository('EasyVentesBundle:Product');
        $products = $repos->findAll();
        return $this->render('EasyVentesBundle:Product:list.html.twig', ['products'=> $products]);
    }

    public function detailAction($id)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('EasyVentesBundle:Product');
        $product = $repo->find($id);

        return $this->render('EasyVentesBundle:Product:detail.html.twig', ['product' => $product]);
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(new ProductType(), new Product());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            
            return $this->redirect($this->generateUrl('easy_product_list'));
        }
        return $this->render('EasyVentesBundle:Product:form.html.twig', ['form' => $form->createView()]);
    }
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:Product');
        $product= $repo->find($id);
        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl("easy_product_list"));
    }

}