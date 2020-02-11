<?php

namespace kiraxe\AdminCrmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SqlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brochure', FileType::class, [
                'label' => 'Загрузить базу данных',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1M',
                        /*'mimeTypes' => ['application/x-sql'],
                        'mimeTypesMessage' => 'Неверный формат файла'*/

                    ])
                ],
            ]);
    }
}
