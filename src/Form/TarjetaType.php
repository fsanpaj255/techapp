<?php

namespace App\Form;

use App\Entity\Tarjeta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class TarjetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroTarjeta', TextType::class, [
                'label' => 'Número de tarjeta',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce el número de tarjeta.']),
                    new CardScheme(['schemes' => ['VISA', 'MASTERCARD'], 'message' => 'El número de tarjeta no es válido.']),
                ],
            ])
            ->add('fechaExpiracion', DateTimeType::class, [
                'label' => 'Fecha de expiración',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM',
                'html5' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, selecciona la fecha de expiración.']),
                    new DateTime(['format' => 'Y-m', 'message' => 'La fecha de expiración no es válida.']),
                ],
            ])
            ->add('cvv', TextType::class, [
                'label' => 'CVV',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce el CVV.']),
                ],
            ])
            ->add('calle', TextType::class, [
                'label' => 'Calle',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce la calle.']),
                ],
            ])
            ->add('codigoPostal', TextType::class, [
                'label' => 'Código Postal',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce el código postal.']),
                ],
            ])
            ->add('ciudad', TextType::class, [
                'label' => 'Ciudad',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce la ciudad.']),
                ],
            ])
            ->add('provincia', TextType::class, [
                'label' => 'Provincia',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce la provincia.']),
                ],
            ])
            ->add('pais', TextType::class, [
                'label' => 'País',
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, introduce el país.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarjeta::class,
        ]);
    }
}