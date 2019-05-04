<?php

namespace AppBundle\Form;

use AppBundle\Entity\PlayerName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playerId')
            ->add('name')
            ->add('date')
            ->add('player')
            ->add('editor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayerName::class,
        ]);
    }
}
