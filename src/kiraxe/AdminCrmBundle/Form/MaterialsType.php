<?php

namespace kiraxe\AdminCrmBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class MaterialsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null ,array('label' => 'Название'))
            ->add('price', HiddenType::class ,array('label' => 'Общая стоимость материала'))
            ->add('quantitypack', null ,array('label' => 'Количество в упаковке'))
            ->add('pricepackage', null ,array('label' => 'Цена за упаковку'))
            ->add('totalsize', null ,array('label' => 'Общее кол-во'))
            /*->add('serviceId', null ,array('label' => 'Услуга'))*/
            ->add('serviceId', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Services',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $services) {
                    return $services->createQueryBuilder('u')
                        ->where('u.parent is NULL');
                },
                'label' => 'Услуга',
                'required' => false,
                'placeholder' => 'Выберите услугу',
                'empty_data' => null,
            ])
            ->add('priceUnit', HiddenType::class ,array('label' => 'Цена за ед'))
            ->add('measureId', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Measure',
                'choice_label' => 'name',
                'label' => 'Мера измерения',
                'required' => false,
                'placeholder' => 'Выберите меру измерения',
                'empty_data' => null,
            ])
            ->add('rating', ChoiceType::class ,
                array(
                    'label' => 'Рейтинг',
                    'choices' => array(
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5,
                    ),
                    'expanded' => true,
                    'required' => false,
                )
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\Materials'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_materials';
    }

}
