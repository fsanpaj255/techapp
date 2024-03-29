<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('tamano', ChoiceType::class, [
                'choices' => [
                    'XL' => 'XL',
                    'L' => 'L',
                    'M' => 'M',
                    'S' => 'S',
                ],
                'attr' => [
                    'class' => 'form-group',
                ],
                'label_attr' => [
                    'class' => 'input',
                ],
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
            ->add('imageFile', VichImageType::class, [
                'label' => 'Cargar imagen ALZADA',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Descargar imagen',
                'attr' => [
                    'class' => ''
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '5M', // Tamaño máximo del archivo (por ejemplo, 5 megabytes)
                        'maxWidth' => 2000, // Ancho máximo en píxeles
                        'maxHeight' => 1500, // Altura máxima en píxeles
                        // También puedes especificar 'minWidth', 'minHeight' para establecer restricciones mínimas
                    ]),
                ],
            ])
            ->add('imageFile2', VichImageType::class, [
                'label' => 'Cargar imagen PLANTA',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Descargar imagen',
                'attr' => [
                    'class' => ''
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '5M', // Tamaño máximo del archivo (por ejemplo, 5 megabytes)
                        'maxWidth' => 2000, // Ancho máximo en píxeles
                        'maxHeight' => 1500, // Altura máxima en píxeles
                        // También puedes especificar 'minWidth', 'minHeight' para establecer restricciones mínimas
                    ]),
                ],
            ])
            ->add('imageFile3', VichImageType::class, [
                'label' => 'Cargar imagen PERFIL',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Descargar imagen',
                'attr' => [
                    'class' => ''
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '5M', // Tamaño máximo del archivo (por ejemplo, 5 megabytes)
                        'maxWidth' => 2000, // Ancho máximo en píxeles
                        'maxHeight' => 1500, // Altura máxima en píxeles
                        // También puedes especificar 'minWidth', 'minHeight' para establecer restricciones mínimas
                    ]),
                ],
            ])
            ->add('imageFile4', VichImageType::class, [
                'label' => 'Cargar imagen RESTANTE',
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Descargar imagen',
                'attr' => [
                    'class' => ''
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '5M', // Tamaño máximo del archivo (por ejemplo, 5 megabytes)
                        'maxWidth' => 2000, // Ancho máximo en píxeles
                        'maxHeight' => 1500, // Altura máxima en píxeles
                        // También puedes especificar 'minWidth', 'minHeight' para establecer restricciones mínimas
                    ]),
                ],
            ])
            ->add('categoria', ChoiceType::class, [
                'choices' => [
                    'Portatil' => 'Portatil',
                    'Sobremesa' => 'Sobremesa',
                    'Teléfono' => 'Teléfono',
                    'Periférico' => 'Periférico',
                    'Electrodoméstico' => 'Electrodoméstico',
                    'Consola' => 'Consola',
                    'Videojuego' => 'Videojuego',
                ],
                'attr' => [
                    'class' => 'form-group',
                ],
                'label_attr' => [
                    'class' => 'input',
                ],
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
