<?php

namespace kiraxe\AdminCrmBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class WorkerOrdersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('workers')
            ->add('workers', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Workers',
                'query_builder' => function (EntityRepository $workers) {
                    return $workers->createQueryBuilder('w')->where("w.typeworkers = 0");
                },
                'choice_label' => 'name',
                'placeholder' => 'Выберите сотрудника',
                'label' => 'Сотрудник'
            ])
            ->add('servicesparent', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Services',
                'query_builder' => function (EntityRepository $services) {
                    return $services->createQueryBuilder('u')
                        ->where('u.parent IS NULL');
                },
                'choice_label' => 'name',
                'label' => 'Вид услуг',
                'placeholder' => 'Выберите вид услуг',
            ])
            ->add('services', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Services',
                'query_builder' => function (EntityRepository $services) {
                    return $services->createQueryBuilder('u')
                        ->where('u.parent IS NOT NULL');
                },
                'choice_label' => 'name',
                'label' => 'Вид работы',
                'placeholder' => 'Выберите вид работы',
            ])
            ->add('materials', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Materials',
                'choice_label' => 'name',
                'label' => 'Материал',
                'placeholder' => 'Выберите материал',
            ])
            ->add('amountOfMaterial', IntegerType::class, array('label' => 'Количество материала',)
            )
            ->add('marriage', IntegerType::class, array(
                'label' => 'Брак',
                'required' => false,
            ))
            ->add('fine', IntegerType::class, array(
                'label' => 'Штраф',
                'required' => false,
            ))
            ->add('price', IntegerType::class, array('label' => 'Стоимость'))
            ->add('salary', HiddenType::class, array('label' => 'Зарплата'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\WorkerOrders'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_workerorders';
    }


}
