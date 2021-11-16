<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class TrickType extends AbstractType
{

    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => $this->translator->trans('This field is missing')]),
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => $this->translator->trans('This field is missing')]),
                ]
            ])
            ->add('trickGroup', EntityType::class, [
                'class' => \App\Entity\Group::class,
                'choice_label' => 'title',
                'placeholder'  => $this->translator->trans('Please choose a group'),
                'constraints'  => [
                    new NotBlank(['message' => $this->translator->trans('Please choose a group')]),
                ]
            ])
            ->add('media', FileType::class, [
                'mapped' => false,
                'multiple' => true,
                'required' =>false,
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'maxSize' => '1024k',
                                'maxSizeMessage' => $this->translator
                                        ->trans('The size of your medias should not exceed')
                                    . '{{ limit }}',
                                'mimeTypes' => [
                                    'image/jpeg',
                                    'image/png',
                                    'video/mp4',
                                    'video/x-msvideo',
                                    'video/webm',
                                ],
                                'mimeTypesMessage' => $this->translator
                                    ->trans("The valid extensions list [jpeg, png, avi, mp4, webm]"),
                            ]),
                        ]
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
