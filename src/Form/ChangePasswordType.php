<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class ChangePasswordType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new UserPassword([
                        'message' => $this->translator->trans('Your current password is incorrect')
                    ]),
                    new NotBlank([
                        'message' => $this->translator->trans('This field is missing'),
                    ]),
                ]
            ])
            ->add('changedPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => array(
                    'label' => $this->translator->trans('New password'),
                    'constraints' => [
                        new NotBlank([
                            'message' => $this->translator->trans('This field is missing'),
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => $this->translator->trans('Your password should be at least') .
                                ' {{ limit }} ' . $this->translator->trans('characters'),
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ]
                ),
                'second_options' => array(
                    'label' => $this->translator->trans('Confirm password')
                ),
                'invalid_message' => $this->translator->trans('The password fields must match.'),
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
