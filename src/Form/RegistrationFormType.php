<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

            $builder
                ->add('photo', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image au format JPEG ou PNG',
                    ])
                ],
            ])

            ->add('email', EmailType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                    'class'=>'form-control'],

                'constraints' => [
                    new NotBlank([
                        'message' => 'S\'il vous plait veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
            ->add('firstName',TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
            ->add('numTel',TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
            ->add('ville',TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
            ->add('codePostal',TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
            ->add('pseudo',TextType::class, [
                'attr' =>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
