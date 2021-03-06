<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Suite;
use App\Repository\ChapitreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class SuiteType extends AbstractType {
    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->chapitreSrc = $options['src'];
        $this->chapitreDest = $options['dest'];

        $builder
            ->add('chapitreSource')
            ->add('chapitreDestination')
            ->add('reponse');

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Suite::class,
            'src' => null,
            'dest' => null,
        ]);
    }

    public function preSetData(FormEvent $event) {
        $form = $event->getForm();
        $suite = $event->getData();

        if($this->chapitreSrc !== null){
            $suite->setChapitreSource($this->chapitreSrc);
            $form->remove("chapitreSource");
        }
        if($this->chapitreDest !== null){
            $suite->setChapitreDestination($this->chapitreDest);
            $form->remove("chapitreDestination");
        }

    }
}

