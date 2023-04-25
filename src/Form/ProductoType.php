<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('precio', null, [
            'attr' => [
                'class' => 'form-group'
            ],'label_attr' => [
                'class' => 'input'
            ]
        ])
            ->add('nombre', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('descripcion', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('ancho', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('largo', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('modelo', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('color', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('peso', null, [
                'attr' => [
                    'class' => 'form-group'
                ],'label_attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('imagen', VichImageType::class, [
                'label' => 'Cargar imagen',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Ver imagen',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
