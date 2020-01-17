<?php

namespace kiraxe\AdminCrmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array(
            'label' => 'ФИО'
        ))
            ->add('avto', null, array(
                'label' => 'Авто'
            ))
            ->add('number', null, array(
                'label' => 'Номер'
            ))
            ->add('vin', null, array(
                'label' => 'vin'
            ))
            ->add('phone', null, array(
                'label' => 'Телефон'
            ))
            ->add('email', null, array(
                'label' => 'Почта'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\Clientele'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_clientele';
    }


}
