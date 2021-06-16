<?php

namespace App\Controller\Evaluator;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Form\SoutType;
use App\Form\EvalEtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    
    public function list_note(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = $repo->findAll();

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('evaluator/group/list_notes.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
        ]);
    }
    
    public function group_list(): Response
    {
        $id_user = $this->getUser()->getIdUser();

        $repo1 = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = $repo1->findAll();

        $total = count($groupes);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('evaluator/group/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total,
            'id_user'   => $id_user
        ]);
    }

    /**
     * @Route("/groupe/{groupId}/soutenance", name="note_soutenance")
     */
    public function group_notes_sout(int $groupId, Request $request, ManagerRegistry $managerRegistry)
    {
        // $groupe_value = $this->getGroupe();
        // $entityManager = $this->getDoctrine()->getManager();
        
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);
        dump($groupe);
        dd($groupe->getIdEvalSout());
        // $groupe_value = $repo->find(soutRapport)
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);
        // $soutenance = new Soutenance();


        // dump($groupe);
        // $form = $this->createForm(SoutType::class, $groupe);
        // $form->handleRequest($request);


        // // $test = $request->request->get('rapport');
        // // dump($test);
        // // dd($request);

        // if($form->isSubmitted() && $form->isValid()){

        //     // $groupe->setSoutRapport($test);
        //     // $groupe->setSoutRapport($test);
        //     // $groupe->setSoutRapport($test);
        //     // $repo->persist($groupe);
        //     // $repo->flush();

        //     $em = $managerRegistry->getManager();
        //     $em->persist($groupe);
        //     $em->flush();
        //     // dump($request->request->get('note_rapport_{{ groupe.numero }}'));
        //     // $groupe->setSoutRapport($request->request->get('note_rapport_{{ groupe.numero }}'));
        //     // $repo = $managerRegistry->getManager();
        //     // redirection
        
        //     $this->addFlash('success', 'Notes mis à jour avec succès');
        // }


        return $this->render('evaluator/group/notes/students_sout.html.twig',[
            'groupId' => $groupId,
            // 'formSout' => $form->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants
            ]);
    }

    public function group_notes_poster(int $groupId): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        return $this->render('evaluator/group/notes/students_poster.html.twig',[
            'groupId' => $groupId,
            'groupe' => $groupe,
            'etudiants' => $etudiants
            ]);
    }

    public function group_notes_indiv(int $groupId, Request $request): Response
    {
        $groupeRepository = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $groupeRepository->find($groupId);

        $studentRepository = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $studentRepository->findBy([
            'idGroupeEtud' => $groupId
        ]);



        if($request->isMethod('post')){

            $datas = $request->request->all();
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($etudiants as $etudiant) {

                $noteTutRapport = $datas['noteTutRapport'.$etudiant->getIdEtud()];
                $noteTutTrav = $datas['noteTutTrav'.$etudiant->getIdEtud()];
                $noteTutCompt = $datas['noteTutCompet'.$etudiant->getIdEtud()];
                $poucentTravail = $datas['pourcentTravail'.$etudiant->getIdEtud()];
                $noteFinale = $datas['noteFinale'.$etudiant->getIdEtud()];

                $etudiant->setNoteTutRapport((float)$noteTutRapport);
                $etudiant->setNoteTutTrav((float)$noteTutTrav);
                $etudiant->setNoteTutCompet((float)$noteTutCompt);
                $etudiant->setPourcentTravail((float)$poucentTravail);
                $etudiant->setNoteFinale((float)$noteFinale);

                $entityManager->persist($etudiant);
            }
            $entityManager->flush();
            $this->addFlash('success', 'Les notes ont été enregistrées avec succès');

        }
        return $this->render('evaluator/group/notes/students_eval.html.twig',[
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            ]);
    }

    // public function group_notes_indiv(int $groupId, Request $request, ManagerRegistry $managerRegistry): Response
    // {
    //     $repo = $this->getDoctrine()->getRepository(Groupe::class);
    //     $groupe = $repo->find($groupId);

    //     $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
    //     $etudiants = $repo2->findBy([
    //         'idGroupeEtud' => $groupId
    //     ]);
    //     // dd($request);
    //     // die;
        
    //     foreach ($etudiants as $etudiant){
    //         $i = 0;
    //         $form = $this->createForm(EvalEtudiantType::class, $etudiant);
    //         // dump($etudiant);
    //         dump($etudiant);
    //     }
    //     // dump($form);
    //     // die;
    //     $form->handleRequest($request);

    //     // dump($request);
        
    //     if($form->isSubmitted() && $form->isValid()){
    //         dump($form);

    //         $groupe->setNoteTutRapport($request->request->get('rapport'));
    //         // $groupe->setNoteTutTrav($request->request->get('travail'));
    //         // $groupe->setNoteTutCompet($request->request->get('competences'));
    //         // $groupe->setPourcentTravail($request->request->get('pourcentage'));
    //         // todo MOYENNE

    //         dump($request->request->get('rapport'));
    //         // dump($request->request->get('travail'));
    //         // dump($request->request->get('competences'));
    //         // dump($request->request->get('pourcentage'));


    //         // $repo->persist($groupe);
    //         // $repo->flush();

    //         $em = $managerRegistry->getManager();
    //         $em->persist($groupe);
    //         $em->flush();
    //         // dump($request->request->get('note_rapport_{{ groupe.numero }}'));
    //         // $groupe->setSoutRapport($request->request->get('note_rapport_{{ groupe.numero }}'));
    //         // $repo = $managerRegistry->getManager();
    //         // redirection
        
    //         $this->addFlash('success', 'Notes mis à jour avec succès');
    //     }



    //     return $this->render('evaluator/group/notes/students_eval.html.twig',[
    //         'groupId' => $groupId,
    //         'groupe' => $groupe,
    //         'etudiants' => $etudiants,
    //         'form' => $form->createView(),
    //         ]);
    // }

    public function group_notes_final(int $groupId): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        return $this->render('evaluator/group/notes/recap_note.html.twig',[
            'groupId' => $groupId,
            'groupe' => $groupe,
            'etudiants' => $etudiants
            ]);
    }
 
}
