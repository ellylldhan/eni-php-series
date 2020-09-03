<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Serie\'s name',
                'attr'  => ['class' => 'input-group mb-3'],
            ])
            ->add('overview', TextareaType::class, [
                'label' => 'Overview',
                'attr'  => ['class' => 'input-group mb-3'],
            ])
            ->add('tmdbId', IntegerType::class, [
                'attr' => ['class' => 'input-group mb-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
                                   'data_class' => Serie::class,
                               ]);
    }
}
