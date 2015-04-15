<?php

namespace Easy\Bundle\ClientBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null, array('label'=> 'Nom', 'attr' => array('class' => 'form-control')))
            ->add('user')
            ->add('event')
            ->add('date')
            ->add('state')
            ->add('btn', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Easy\Bundle\VentesBundle\Entity\UserEvent',
        ));
    }

    public function getName()
    {
        return 'user_event_form';
    }

}