<?php

namespace App\Form;

use App\Entity\Histoire;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoireType extends AbstractType
{
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Histoire::class,
        ]);
    }
}
