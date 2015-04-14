<?php

namespace Ipf\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastname', null, array('label' => 'Nom', 'read_only' => true))
                ->add('firstname', null, array('label' => 'Prénom', 'read_only' => true))
                ->add('adress', null, array('read_only' => true))
                ->add('zip', null, array('read_only' => true))
                ->add('city', null, array('read_only' => true))
                ->add('price', 'money', array('read_only' => true))
                ->add('products', null, array('read_only' => true))
                ->add('createdAt', 'datepicker', array(
                    'use_jquery' => true,
                    'format' => 'dd/MM/yyyy',
                    'read_only' => true
                ))
                ->add('dateSend', 'datepicker', array(
                    'use_jquery' => true,
                    'format' => 'dd/MM/yyyy',
                ))
                ->add('btn', 'submit', array('label' => 'Envoyer'));
        
        return $builder;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipf\CartBundle\Entity\Command',
        ));
        
        return $resolver;
    }
    
    public function getName()
    {
        return 'command_form';
    }

}
