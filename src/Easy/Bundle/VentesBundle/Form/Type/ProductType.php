<?php

namespace Easy\Bundle\VentesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of CategoryType
 *
 * @author student
 */
class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null, array('label'=> 'Nom', 'attr' => array('class' => 'form-control')))
            ->add('description')
            ->add('picture')
            ->add('price')
            ->add('qty')
            ->add('categories')
            ->add('active', null, array(
                'label'=> 'Active',
                'data' => true,
                'attr' => array('required' => false )))
            ->add('btn', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Easy\Bundle\VentesBundle\Entity\Product',
        ));
    }

    public function getName()
    {
        return 'product_form';
    }

}
