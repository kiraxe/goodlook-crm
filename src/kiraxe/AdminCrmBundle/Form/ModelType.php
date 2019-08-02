<?php

namespace kiraxe\AdminCrmBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brandId', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Brand',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $brand) {
                    return $brand->createQueryBuilder('b');
                },
                'label' => 'Бренд',
                'required' => false,
                'placeholder' => 'Выберите бренд',
                'empty_data' => null,
            ])
            ->add('name', null ,array('label' => 'Модель'))
            ->add('year', null ,array('label' => 'Год выпуска'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\Model'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_model';
    }


}
