<?php

namespace AppBundle\Form;

use AppBundle\Entity\PlayerLvl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerLvlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lvl')
            ->add('date')
            ->add('player')
            ->add('editor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayerLvl::class,
        ]);
    }
}
