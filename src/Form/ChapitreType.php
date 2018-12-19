<?php

namespace App\Form;

use App\Entity\Chapitre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitreType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('texte')
            ->add('titre')
            ->add('titreCourt')
            ->add('photo')
            ->add('question')
            ->add('premier',CheckboxType::class, [
                'required' => false
            ])
            ->add('histoire');
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
        ]);
    }
}
