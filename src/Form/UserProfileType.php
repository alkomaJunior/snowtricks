<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserProfileType extends AbstractType
{

    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => $this->translator->trans('This field is missing')]),
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => $this->translator->trans('This field is missing')]),
                    new Email(['message' => $this->translator->trans('This field is not a valid email address')]),
                ]
            ])
            ->add('media', FileType::class, [
                'mapped' => false,
                'required' =>false,
                'constraints' => [
                    new File([
                        'maxSize' => '3072k',
                        'maxSizeMessage' => $this->translator
                                ->trans('The size of your medias should not exceed')
                            . '{{ limit }}',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'video/mp4',
                        ],
                        'mimeTypesMessage' => $this->translator
                            ->trans("The valid extensions list [jpeg, png, avi, mp4, webm]"),
                    ]),
                ],
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
