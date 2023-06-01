<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce un apodo',
                    ]),
                ],
            ])
            ->add('nombre', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce un nombre',
                    ]),
                ],
            ])
            ->add('apellidos', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce los apellidos',
                    ]),
                ],
            ])
            ->add('dni', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce el DNI',
                    ]),
                    new Regex([
                        'pattern' => '/^\d{8}[A-Z]$/',
                        'message' => 'El formato del DNI es incorrecto',
                    ]),
                ],
            ])
            ->add('correo', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce un correo electrónico',
                    ]),
                    new Email([
                        'message' => 'El correo electrónico no es válido',
                    ]),
                ],
            ])
            // ->add('fechaExpiracion', TextType::class, [
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Por favor, introduce la fecha de expiración',
            //         ]),
            //         new Regex([
            //             'pattern' => '/^(0[1-9]|1[0-2])\/20[0-9]{2}$/',
            //             'message' => 'La fecha de expiración es inválida',
            //         ]),
            //     ],
            // ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes aceptar nuestros términos.',
                    ]),
                ],
                'label' => 'Aceptar términos',
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce una contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/.*[0-9].*/',
                        'message' => 'La contraseña debe contener al menos un número',
                    ]),
                ],
                'label' => 'Contraseña',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
