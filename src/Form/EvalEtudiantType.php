<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EvalEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add("prenom",
            //     CollectionType::class
            // )
            ->add('noteTutRapport')
            ->add('noteTutTrav')
            ->add('noteTutCompet')
            ->add('pourcentTravail')
            // ->add('noteTut5')
            // ->add('noteTut20')
            // ->add('noteFinale')
            // ->add('idGroupeEtud')
            // ->add('idPromo')
            // ->add('idUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
