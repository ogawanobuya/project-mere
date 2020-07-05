<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'ニックネーム',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('profile', TextareaType::class, [
                'label' => 'プロフィール',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => '10']
            ])
            ->add('isPermitEmail', CheckboxType::class, [
                'label' => 'Emailの公開を許可する',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}