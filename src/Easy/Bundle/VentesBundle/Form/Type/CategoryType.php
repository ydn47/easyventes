<?php

namespace Easy\Bundle\VentesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Nom'))
            ->add('active', null, array('data' => true,
                'required' => false))
            ->add('btn', 'submit', array('label' => 'Envoyer'));

        return $builder;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Easy\Bundle\VentesBundle\Entity\Category',
        ));

        return $resolver;
    }

    public function getName()
    {
        return 'category_form';
    }
}