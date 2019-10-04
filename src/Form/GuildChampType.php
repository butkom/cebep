<?php

namespace App\Form;

use App\Entity\GuildChamp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuildChampType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place')
            ->add('comment')
            ->add('guild')
            ->add('champ')
            ->add('editor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GuildChamp::class,
        ]);
    }
}
