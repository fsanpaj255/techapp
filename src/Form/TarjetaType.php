<?php

namespace App\Form;

use App\Entity\Tarjeta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarjetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroTarjeta', TextType::class, [
                'label' => 'Número de tarjeta',
                'required' => true,
            ])
            ->add('fechaExpiracion', TextType::class, [
                'label' => 'Fecha de expiración',
                'required' => true,
            ])
            ->add('cvv', TextType::class, [
                'label' => 'CVV',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarjeta::class,
        ]);
    }
}