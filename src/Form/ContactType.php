<?php

namespace App\Form;
use App\Entity\User;
use App\Entity\Projet;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('email', EmailType::class, [
            //     'label' => "A",
            //     'required' => false
            // ])
            // ->add(
            //     'notificationEmails',
            //      CollectionType::class,
            //      array(
            //         'entry_type' => EmailType::class,
            //          'label' => 'Add more emails separated by comma',
            //          'attr' => array(
            //              'multiple' => 'multiple',
            //          ),
            //      )
            //  )
  
            ->add('users', EntityType::class, [
                'class' => User::class,
                'label' => 'A',
                'help' => 'Vous pouvez sélectionner plusieurs utilisateurs.',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.email is not NULL')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => function (User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom(). ' ' . $user->getEmail(); },
            ])
            ->add('users_cc', EntityType::class, [
                'class' => User::class,
                'label' => 'Cc',
                'required' => false,
                'help' => 'Vous pouvez sélectionner plusieurs utilisateurs.',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.email is not NULL')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => function (User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom(). ' ' . $user->getEmail(); },
            ])
            
            // ->add('emails', CollectionType::class, [
            //     // each entry in the array will be an "email" field
            //     'entry_type' => EmailType::class,
            //     // these options are passed to each "email" type
            //     'entry_options' => [
            //         'attr' => ['class' => 'email-box'],
            //     ],
            // ])            
            // ->add('cc', EmailType::class, [
            //   'label' => "Cc",
            //   'required' => false
            // ])
            ->add('objet')
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                    // 'id' => 'contact_message'
                ]
            ])  
            ->add('fichiers', FileType::class, [
                'label' => "Joindre des fichiers",
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Selectionner des fichiers...',
                    'multiple' => true,
                    'onchange' => "javascript:updateList()",
                    'id' => "attachFiles"
                ]
            ])
            // 'multiple' : 'true' , 'id' : "attachFiles", 'onchange': "javascript:updateList()"
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
