<?php

namespace App\Form;

use App\Entity\Histoire;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class HistoireType extends AbstractType
{

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('pitch')
            ->add('photoFile', FileType::class, array('label' => 'Image'))
            ->add('actif',CheckboxType::class)
            ->add('genre')
            ->add('user')
        ;
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Histoire::class,
        ]);
    }

    public function preSetData(FormEvent $event){
        $form = $event->getForm();
        $histoire = $event->getData();

        if(!($this->securityChecker->isGranted('ROLE_SUPER_ADMIN') === true)) {
            $histoire->setUser($this->token->getToken()->getUser());
            $form->remove("user");
        }
    }

}
