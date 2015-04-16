<?php
namespace Easy\Bundle\VentesBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class RegistrationType extends BaseType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Email'))
            ->add('userlastname', null, array('label' => 'Nom'))
            ->add('userfirstname', null, array('label' => 'Prénom'))
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('newsletter', null, array('required' =>false))
            ->add('nbevent', 'hidden', array('data' => 0))
        ;
        
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
