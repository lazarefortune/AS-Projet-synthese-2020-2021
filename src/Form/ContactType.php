<?php

namespace App\Form;
use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
              'label' => "A"
            ])
            ->add('cc', EmailType::class, [
              'label' => "Cc",
              'required' => false
            ])
            ->add('objet')
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows' => 12
                ]
            ])
            ->add('fichiers', FileType::class, [
                'label' => "Joindre des fichiers",
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Selectionner des fichiers...',
                    'multiple' => true,
                    'onchange' => "javascript:updateList()",
                    'id' => "attachFiles"
                ]
            ])
            // ->add('projets', EntityType::class, [
            //     'class' => Projet::class,
            //     'label' => false,
            //     'choice_label' => 'titre'
            // ])
            // 'multiple' : 'true' , 'id' : "attachFiles", 'onchange': "javascript:updateList()"
            // ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
