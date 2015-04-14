<?php
namespace Easy\Bundle\VentesBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationType extends BaseType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder->add('roles')
                ->add('userlastname', null, array('label' => 'Nom'))
                ->add('btn', 'submit', array('label' => 'Envoyer'));
        
        return $builder;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Easy\Bundle\VentesBundle\Entity\User'
        ));
    }
    
    public function getName()
    {
        return 'easy_user_registration';
    }

}
