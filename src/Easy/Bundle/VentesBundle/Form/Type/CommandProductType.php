<?php

namespace Ipf\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandProductType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('product', null, array('label' => 'Produit'))
                ->add('qty', null, array('label' => 'Quantité'));
        
        return $builder;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipf\CartBundle\Entity\CommandProduct',
        ));
        
        return $resolver;
    }
    
    public function getName()
    {
        return 'command_product_form';
    }

}
