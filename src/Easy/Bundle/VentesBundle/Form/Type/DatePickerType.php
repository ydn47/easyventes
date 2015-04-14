<?php

namespace Ipf\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatePickerType extends AbstractType
{
    public function getParent()
    {
        return 'date';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'use_jquery' => false,
        ));
        
        $resolver->setNormalizers(array(
            
            'widget' => function (Options $options, $value) {
                if ($options['use_jquery']) {
                    return 'single_text';
                }
                return $value;
            }  
        ));
        return $resolver;
    }
    
    public function getName()
    {
        return 'datepicker';
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if ('single_text' == $options['widget'] && $options['use_jquery']) {
            $view->vars['type'] = 'text';
        }
    }

}