<?php

namespace Easy\Bundle\VentesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Easy\Bundle\VentesBundle\Entity\ProductSale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductSaleController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EasyVentesBundle:Event');
        $sess = $this->get('session');
        $sess->set('event_id', $request->get('id'));
        $event = $repo->find($request->get('id'));
        if (empty($event)) {
            return $this->redirect($this->generateUrl('easy_event_list'));
        }
        $categories = $event->getCategories();
        $repoP = $em->getRepository('EasyVentesBundle:Product');
        $repoPS = $em->getRepository('EasyVentesBundle:ProductSale');
        $products = array();
        foreach ($categories as $category) {
            $productsType = $repoP->findProductsType($category->getId());
            foreach ($productsType as $product) {
                $p = $repoP->find($product->getId());
                $ps = $repoPS->findBy(array('product' => $product, 'event' => $event));
                if ($ps) {
                    $p->setQty($ps[0]->getQty());
                    $products[] = $p;
                } else {
                    if ($p->getActive()) {
                        $p->setQty(0);
                        $products[] = $p;
                    }
                }
                
            }
        }
        
        return $this->render('EasyVentesBundle:ProductSale:list.html.twig', array('products' => $products));
    }
    
    public function bestAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repoE = $em->getRepository('EasyVentesBundle:Event');
        $repo = $em->getRepository('EasyVentesBundle:ProductSale');
        $events = $repoE->findThreeEvents();
        $products = array();
        foreach ($events as $event) {
            $productSale = $repo->findBy(array('event' => $event));
            foreach ($productSale as $ps) {
                if (isset($products[$ps->getProduct()->getId()])) {
                    $products[$ps->getProduct()->getId()] = $products[$ps->getProduct()->getId()] + $ps->getQty();
                } else {
                    $products[$ps->getProduct()->getId()] = $ps->getQty();
                }
                
            }
            
        }
        $i = 0;
        $best = array();
        while ($i < 10) {
            if (!$products) {
                $i = 10;
            }
            foreach ($products as $id => $qty) {
                foreach ($products as $idc => $qtyc) {
                    if (isset($best[$i][1])) {
                        if ($qtyc > $best[$i][1] && $idc !== $best[$i][0]) {
                           $best[$i][0] = $idc;
                           $best[$i][1] = $qtyc;
                        }
                    } else {
                        $best[$i][0] = $id;
                        $best[$i][1] = $qty;
                    }
                }
                unset($products[$best[$i][0]]);
                $i++;
                break;
            }
        }
        $i = 0;
        $products = array();
        $repoP = $em->getRepository('EasyVentesBundle:Product');
        while ($i < 10) {
            if (isset($best[$i][0])) {
                $product = $repoP->find($best[$i][0]);
                $product->setQty($best[$i][1]);
                $products[] = $product;
            }

            $i++;
        }
        return $this->render('EasyVentesBundle:ProductSale:best.html.twig', array('products' => $products));
    }

    public function updateAction()
    {
        $sess = $this->get('session');
        $event_id = $sess->get('event_id');
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $qty        = isset($_POST['qty'])        ? $_POST['qty']        : null;
        
        
        if (empty($event_id) || empty($product_id) || empty($qty)) {
            return $this->redirect($this->generateUrl('easy_event_list'));
        } else {
            $em = $this->getDoctrine()->getManager();
            $repoE = $em->getRepository('EasyVentesBundle:Event');
            $repoP = $em->getRepository('EasyVentesBundle:Product');
            $repoPS = $em->getRepository('EasyVentesBundle:ProductSale');
            $event = $repoE->find($event_id);
            $product = $repoP->find($product_id);
            $fb = $sess->getFlashbag();
            $ps = $repoPS->findBy(array('product' => $product, 'event' => $event));
            if ($ps) {
                $nbProduct = $ps[0]->getQty() + $product->getQty();
                $diff = $ps[0]->getQty() - $qty;
            } else {
                $nbProduct = $product->getQty();
                $diff = 0 - $qty;
            }
            if ($nbProduct < $qty) {
                $fb->add('warning', "Vous avez moins de ".$qty." ".$product->getName()." en stock");
            } else {
                if ($qty < 0) {
                    $fb->add('warning', "La quantité doit être positive");
                } else {
                   if (!$ps) {
                       $productSale = new ProductSale();
                       $productSale->setEvent($event)
                                   ->setProduct($product)
                                   ->setQty($qty);

                       $em->persist($productSale);
                       
                   } else {
                       $ps[0]->setQty($qty);
                       $em->persist($ps[0]);
                   }
                   
                   $em->flush();
                   
                   $product->setQty($product->getQty() + $diff);
                   $em->persist($product);
                   $em->flush();
                   
                   
                   
                   $fb->add('success', "Modification effectuée");
                }
            }


            return $this->redirect($this->generateUrl("easy_productsale_list", array('id' => $event_id)));
        }
        
    }

}