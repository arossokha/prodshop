<?php

namespace CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('customer', 'entity', ['class' => 'CustomerBundle\Entity\Customer', 'required' => true, 'label' => 'For client', 'empty_value' => 'Choose client please...'])
            ->add('orderProducts', 'collection', [
                'type' => new OrderProductType(),
                'allow_add' => true,
                'by_reference' => false,
                'attr' => ['class' => 'products']])
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
