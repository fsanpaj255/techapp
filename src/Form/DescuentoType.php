<?php

namespace App\Form;
use App\Entity\Oferta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DescuentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentaje', IntegerType::class, [
                'label' => 'Porcentaje de descuento',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('guardar', SubmitType::class, [
                'label' => 'Aplicar descuento',
                'attr' => [
                    'class' => 'btn-delete',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oferta::class, // Actualizamos la clase asociada al formulario
        ]);
    }
}