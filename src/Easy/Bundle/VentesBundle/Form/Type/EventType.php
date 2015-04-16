<?php
/**
 * Created by PhpStorm.
 * User: Pauline
 * Date: 14/04/2015
 * Time: 14:56
 */

namespace Easy\Bundle\VentesBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null, array('label' => 'Nom', 'attr' => array('class' => 'form-control')))
            ->add('nbpers', null, array('label' => 'Nombre de places'))
            ->add('dateStart')
            ->add('dateEnd')
            ->add('description')
            ->add('categories')
            ->add('btn', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Easy\Bundle\VentesBundle\Entity\Event',
        ));
    }

    public function getName()
    {
        return 'event_form';
    }
}