<?php

namespace App\Form;

use App\Entity\DateAccesSout;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DateAccessSoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', DateTimeType::class, [
                'label' => false,
                'widget' => 'single_text',
                ])
            ->add('dateFin', DateTimeType::class , [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'id' => 'datepicker'
                ],
                ])
            ->add('motif')
            // ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DateAccesSout::class,
        ]);
    }
}
