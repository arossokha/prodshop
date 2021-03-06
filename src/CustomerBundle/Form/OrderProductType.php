<?php

namespace CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('order_id','hidden')
            ->add('product_id','hidden',['attr' => ['class' => 'productId']])
            ->add('quantity',null,['attr' => ['class' => 'productQuantity']])
            ->add('price','hidden',['attr' => ['class' => 'productPrice']])
//            ->add('order') // don't may be this will need in for other forms
//            ->add('product')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CustomerBundle\Entity\OrderProduct'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'customerbundle_orderproduct';
    }
}
