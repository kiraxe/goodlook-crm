<?php

namespace kiraxe\AdminCrmBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CalendarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'ФИО'
            ])
            ->add('phone', TelType::class, [
                'label' => "Телефон"
            ])
            ->add('id', HiddenType::class, [
                'data' => ""
            ])
            ->add('date', DateTimeType::class ,array(
                  'label' => 'Дата и время (открытие)',
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                )
            )
            ->add('datecl', DateTimeType::class ,array(
                    'label' => 'Дата и время (закрытие)',
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                )
            )
            ->add('text', TextareaType::class, [
                'label' => 'Текст'
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\Calendar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_calendar';
    }


}
