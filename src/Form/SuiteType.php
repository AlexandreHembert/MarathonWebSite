<?php

namespace App\Form;

use App\Entity\Suite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiteType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('chapitreSource')
            ->add('chapitreDestination')
            ->add('reponse');
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Suite::class,
        ]);
    }

    public function preSetData(FormEvent $event){
        $form = $event->getForm();
        $suite = $event->getData();

    }
}

