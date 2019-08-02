<?php

namespace kiraxe\AdminCrmBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class WorkerServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('services', EntityType::class , [
            'class' => 'kiraxe\AdminCrmBundle\Entity\Services',
            'query_builder' => function (EntityRepository $services) {
                return $services->createQueryBuilder('u')
                ->where('u.parent is NULL');
            },
            'choice_label' => 'name',
            'label' => 'Услуга'
        ])
            ->add('percent', null ,array('label' => 'Процент'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'kiraxe\AdminCrmBundle\Entity\WorkerService'
        ));
    }

    public function getBlockPrefix()
    {
        return 'kiraxe_admin_crm_bundle_worker_service_type';
    }
}
