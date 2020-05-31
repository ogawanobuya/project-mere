<?php

namespace App\Form;

use App\Entity\IdeaAsk;
use App\Entity\IdeaCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeaAskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ideaCategories = $options['ideaCategories'];
        $builder
            ->add('ideaCategory', EntityType::class, [
                'class' => IdeaCategory::class,
                'choice_label' => 'name',
                'choices' => $ideaCategories,
                'label' => '募集したいアイデアのカテゴリ',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('title', TextType::class, [
                'label' => '募集タイトル',
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => '募集内容詳細',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => '10']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IdeaAsk::class,
            'ideaCategories' => array(),
        ]);
    }
}
