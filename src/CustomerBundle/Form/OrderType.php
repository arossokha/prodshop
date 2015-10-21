<?php

namespace CustomerBundle\Form;

use ProductBundle\Form\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CustomerBundle\Entity\Customer;

class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sum')
            ->add('date')
            ->add('customer', null, ['label' => 'Customer'])
//            ->add('products','collection',[
//                'type' => new ProductType(),
//                'allow_add' => true,
////                'allow_delete' => true,
//
//            ]);
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CustomerBundle\Entity\Order'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'customerbundle_order';
    }
}
