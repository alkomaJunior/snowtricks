<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Contracts\Translation\TranslatorInterface;

class MediaType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isFrontPageMedia', CheckboxType::class, [
                'label' => $this->translator->trans('Media front page'),
            ])
            ->add('mediaUrl', TextType::class, [
                'required' => false,
            ])
            ->add('media', FileType::class, [
                'mapped' => false,
                'required' =>false,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
