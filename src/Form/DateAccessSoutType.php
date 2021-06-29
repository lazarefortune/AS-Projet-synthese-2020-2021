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
                'attr' => [
                    'required' => true,
                    'value' => date("Y-m-d H:i", strtotime("now") )
                ]
                ])
            ->add('dateFin', DateTimeType::class , [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'id' => 'datepicker',
                    'required' => true,
                    'value' => date("Y-m-d H:i", strtotime("now") )
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
