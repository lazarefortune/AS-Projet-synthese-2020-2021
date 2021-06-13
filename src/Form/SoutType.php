<?php

namespace App\Form;

use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('soutRapport',  ['attr': {
            //         'class': "moyenne{{ groupe.numero }}",
            //         'type': "number"
            //     }] )
            // ->add('soutRapport', NumberType::class, [
            //     'attr'=> [
            //         'type'=> 'number',
            //         'min' => 0,
            //         'max' => 20,
            //     ]     
            // ]
            // )
            ->add('soutRapport')
            ->add('soutAvancement')
            ->add('soutCompetences')
            // ->add('noteSout')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}
