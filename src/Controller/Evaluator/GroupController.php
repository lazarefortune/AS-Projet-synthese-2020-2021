<?php

namespace App\Controller\Evaluator;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Form\SoutType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    
    public function group_list(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = $repo->findAll();

        $total = count($groupes);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('evaluator/group/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
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
        // $groupe_value = $repo->find(soutRapport)
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);
        // dump($groupe);
        // $soutenance = new Groupe();
        $form = $this->createForm(SoutType::class, $groupe);
        $form->handleRequest($request);


        $test = $request->request->get('rapport');
        // dump($test);
        // dd($request);

        if($form->isSubmitted() && $form->isValid()){

            $groupe->setSoutRapport($test);
            $groupe->setSoutRapport($test);
            $groupe->setSoutRapport($test);
            // $repo->persist($groupe);
            // $repo->flush();

            $em = $managerRegistry->getManager();
            $em->persist($groupe);
            $em->flush();
            // dump($request->request->get('note_rapport_{{ groupe.numero }}'));
            // $groupe->setSoutRapport($request->request->get('note_rapport_{{ groupe.numero }}'));
            // $repo = $managerRegistry->getManager();
            // redirection
        
            $this->addFlash('success', 'Notes mis à jour avec succès');
        }


        return $this->render('evaluator/group/notes/students_sout.html.twig',[
            'groupId' => $groupId,
            'formSout' => $form->createView(),
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

    public function group_notes_indiv(int $groupId): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        return $this->render('evaluator/group/notes/students_eval.html.twig',[
            'groupId' => $groupId,
            'groupe' => $groupe,
            'etudiants' => $etudiants
            ]);
    }

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
