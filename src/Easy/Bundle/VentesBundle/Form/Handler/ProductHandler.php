<?php

namespace Ipf\CartBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ProductHandler
{

    private $form;
    private $request;
    private $em;
    
    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->em      = $em;
    }
    
    public function getForm()
    {
        return $this->form;
    }
    
    public function process()
    {
        if (null !== $this->request->get('id')) {
            $this->getForm()->add('active', null, array('required' => false))
                            ->add('btn', 'submit', 
                                       array('label' => 'Modifier'));
            $this->onUpdate();
        } else {
            $this->getForm()->add('btn', 'submit', array('label' => 'Ajouter'));
        }
        $this->form->handleRequest($this->request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->onSuccess();
            return true;
        }
        return false;
    }
    
    protected function onSuccess()
    {
        $this->em->persist($this->form->getData());
        $this->em->flush();
    }
    
    protected function onUpdate()
    {
        
        $repo = $this->em->getRepository('IpfCartBundle:Product');
        $product = $repo->find($this->request->get('id'));
        if ($product) {
            $this->getForm()->setData($product);
            return true;
        }
        
        throw new EntityNotFoundException('Aucun produit trouvé !');
    }

}
