<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use App\Entity\Direccion;

class DireccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calle', TextType::class, [
                'label' => 'Calle',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa la calle.',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'La calle no puede tener más de {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('codigopostal', IntegerType::class, [
                'label' => 'Código Postal',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa el código postal.',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'El código postal debe tener exactamente {{ limit }} dígitos.',
                    ]),
                ],
            ])
            ->add('ciudad', TextType::class, [
                'label' => 'Ciudad',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa la ciudad.',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'La ciudad no puede tener más de {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('provincia', TextType::class, [
                'label' => 'Provincia',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa la provincia.',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'La provincia no puede tener más de {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('pais', TextType::class, [
                'label' => 'País',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa el país.',
                    ]),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'El país no puede tener más de {{ limit }} caracteres.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Direccion::class,
        ]);
    }
}