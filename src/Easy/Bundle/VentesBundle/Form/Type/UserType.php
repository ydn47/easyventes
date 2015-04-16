<?php
namespace Easy\Bundle\VentesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserType extends AbstractType
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
                'required' => false
            ))
            ->add('newsletter', null, array('required' => false))
            ->add('btn', 'submit', array('label' => 'Modifier'))
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
        return 'user_form';
    }

}
