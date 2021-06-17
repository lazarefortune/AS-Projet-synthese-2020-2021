<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EvalSoutNotationRepository;
use App\Repository\EvalPosterNotationRepository;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends AbstractController
{

    public function list_note(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = $repo->findAll();

        $total = count($groupes);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('admin/group/list_notes.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }

    public function group_list(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $allGroupes = $repo->findAll();
        
        
        // il faut faire une find par promo
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == 2){
                $groupes[] = $groupe;
            }
        }

        $total = count($groupes);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();
        
        return $this->render('admin/group/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }
    
    public function group_notes(int $groupId): Response
    {
        $repo1 = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo1->find($groupId);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        // $notes_sout = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
        // $notes_sout = $evalSoutNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
        
        return $this->render('admin/group/notes/show.html.twig',[
            'groupId' => $groupId,
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            ]);
    }

    // public function edit_note(int $groupId, string $typeEval){
    //     $repo = $this->getDoctrine()->getRepository(Groupe::class);
    //     $groupe = $repo->find($groupId);

    //     $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
    //     $etudiants = $repo2->findBy([
    //         'idGroupeEtud' => $groupId
    //     ]);

    //     if ($typeEval == "soutenance") {
    //         return $this->render('admin/group/notes/edit_sout.html.twig',[
    //             'groupId' => $groupId,
    //             'groupe' => $groupe,
    //             'etudiants' => $etudiants
    //         ]);
    //     }
    //     if ($typeEval == "poster") {
    //         return $this->render('admin/group/notes/edit_poster.html.twig',[
    //             'groupId' => $groupId,
    //             'groupe' => $groupe,
    //             'etudiants' => $etudiants
    //             ]);
    //     }
    // }

    public function list_eval(int $groupId, string $typeEval, EvalSoutNotationRepository $evalSoutNotationRepo, EvalPosterNotationRepository $evalPosterNotationRepo){
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        //? VOIR group_notes_sout()    controller_eval
        
        //todo get n° projet             $groupId
        
        //todo faire un repo
        //todo créer une fonction qui liste les groupes
        $repo2 = $this->getDoctrine()->getRepository(User::class);

        $evalsSout = $evalSoutNotationRepo->selectAllNotesSout($groupId, "eval_sout");
        foreach ($evalsSout as $eval) {
            $listEval[] = $repo2->find((int)$eval['id_eval_sout']);
        }

        $evalsPoster = $evalPosterNotationRepo->selectAllNotesPoster($groupId, "eval_poster");
        foreach ($evalsPoster as $eval) {
            $listEval[] = $repo2->find((int)$eval['id_eval_post']);
        }

        if ($typeEval == "soutenance") {
            return $this->render('admin/group/notes/list_sout_eval.html.twig',[
                'groupId' => $groupId,
                'groupe'  => $groupe,
                'evals'   => $listEval,
            ]);
        }
        if ($typeEval == "poster") {
            return $this->render('admin/group/notes/list_poster_eval.html.twig',[
                'groupId' => $groupId,
                'groupe' => $groupe,
                'evals'   => $listEval,
                ]);
        }
    }


    
}
