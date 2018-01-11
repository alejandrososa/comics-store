<?php

namespace App\Accounts\Infrastructure\Form;

use App\Accounts\Application\Request\User\UserSignUpRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class SignUpUserType
 * @package App\Infrastructure\Form
 */
class UserSignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'user.exception.name.not_blank']),
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'user.exception.email.not_blank']),
                ]
            ])
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserSignUpRequest::class,
            'empty_data' => function (FormInterface $form) {
                return new UserSignUpRequest(
                    $form->get('name')->getData(),
                    $form->get('email')->getData()
                );
            }
        ]);
    }
}
