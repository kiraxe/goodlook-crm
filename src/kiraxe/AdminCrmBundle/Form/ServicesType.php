<?php

namespace kiraxe\AdminCrmBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    private $obj_name;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->obj_id = $options['obj_id'];

        $builder->add('name', null ,array('label' => 'Название'))
            ->add('free', null , array('label' => 'Свободный ввод'))
            ->add('parent', EntityType::class , [
                'class' => 'kiraxe\AdminCrmBundle\Entity\Services',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $services) {
                    return $services->createQueryBuilder('u')
                        ->where('u.id !=' . (int)$this->obj_id)->andWhere('u.parent is NULL');
                },
                'label' => 'Родительская услуга',
                'required' => false,
                'placeholder' => 'Выберите родительскую услугу',
                'empty_data' => null,
            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\Services',
        ));
        $resolver->setRequired('obj_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kiraxe_admincrmbundle_services';
    }


}
