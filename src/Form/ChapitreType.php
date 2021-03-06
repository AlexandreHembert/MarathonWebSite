<?php

namespace App\Form;

use App\Entity\Chapitre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ChapitreType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->histoire = $options['histoire'];
        $this->chapitre = $options['chapitre'];

        $builder
            ->add('texte')
            ->add('titre')
            ->add('titreCourt')
            ->add('photoFile',FileType::class, array('label' => 'Image'))
            ->add('question')
            ->add('premier', CheckboxType::class)
            ->add('histoire');
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
            'histoire' => null,
            'chapitre' => null
        ]);
    }

    public function preSetData(FormEvent $event) {
        $form = $event->getForm();
        $chapitre = $event->getData();
        $form->remove('premier');

        if ($this->histoire !== null) {
            $form->remove('histoire');
            $chapitre->setHistoire($this->histoire);
        }
        if ($this->chapitre === null) {
            $chapitre->setPremier(true);
        }else{
            $chapitre->setPremier(false);
        }
    }
}