<?php

namespace App\Controller\Evaluator;

use App\Entity\Groupe;
use App\Entity\Projet;
use App\Entity\Etudiant;
use App\Form\EvalNotationType;
use App\Repository\EvalGroupeRepository;
use App\Repository\EvalSoutNotationRepository;
use App\Repository\EvalPosterNotationRepository;
use App\Repository\MoyenneRepository;
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
    public function group_notes_sout(int $groupId, Request $request, EvalSoutNotationRepository $evalSoutNotationRepo, MoyenneRepository $moyenneRepo)
    {
        
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);
        $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
        //  if note exists
        if($var){
            // update row note sout
            $notes = $var[0];
        }else{
            // create row note sout
            $notes = [
                "sout_qual_pres" => null,
                "sout_trav" => null,
                "sout_compet" => null,
                "sout_moyenne" => null
            ];
        }

        $entityManager = $this->getDoctrine()->getManager();
        $formNotation = $this->createForm(EvalNotationType::class);
        if($request->isMethod('post')){
            $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
            // get data of form
            $datas = $request->request->all();
            $datas = $datas["eval_notation"];
            // on test si on a déjà noté ce groupe
            if($var){
                // update row 
                $evalSoutNotationRepo->updateNoteGroupeSout($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                
                $moySout = $moyenneRepo->moyenneSout($groupId);
                $groupe->setNoteSout((float)$moySout[0]["moySoutenance"]);
                
                $entityManager->persist($groupe);
                $entityManager->flush();
                
                //update vue
                $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
                $notes = $var[0];

                $this->addFlash('success', 'Notes mis à jour avec succès');
            }else{
                // create row
                $evalSoutNotationRepo->insertNoteGroupeSout($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
                
                $moySout = $moyenneRepo->moyenneSout($groupId);
                $groupe->setNoteSout((float)$moySout[0]["moySoutenance"]);
                
                $entityManager->persist($groupe);
                $entityManager->flush();

                $notes = $var[0];
                $this->addFlash('success', 'Notes insérées avec succès');
            }
        }
    
        return $this->render('evaluator/group/notes/soutenance/students_sout.html.twig',[
            'groupId' => $groupId,
            'formNotation' => $formNotation->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            'notes' => $notes
            ]);
    }

    public function group_notes_poster(int $groupId, Request $request, EvalPosterNotationRepository $evalPosterNotationRepo, MoyenneRepository $moyenneRepo)
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
        //  if note exists
        if($var){
            // update row note poster
            $notes = $var[0];
        }else{
            // create row note poster
            $notes = [
                "poster_qual_pres" => null,
                "poster_trav" => null,
                "poster_compet" => null,
                "poster_moyenne" => null
            ];
        }

        $entityManager = $this->getDoctrine()->getManager();
        $formNotation = $this->createForm(EvalNotationType::class);
        if($request->isMethod('post')){
            $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
            // get data of form
            $datas = $request->request->all();
            $datas = $datas["eval_notation"];
            // on test si on a déjà noté ce groupe
            if($var){
                // update row 
                $evalPosterNotationRepo->updateNoteGroupePoster($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                
                $moyPost = $moyenneRepo->moyennePoster($groupId);
                $groupe->setNotePoster((float)$moyPost[0]["moyPoster"]);

                $entityManager->persist($groupe);
                $entityManager->flush();
                //update vue
                $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
                $notes = $var[0];

                $this->addFlash('success', 'Notes mis à jour avec succès');
            }else{
                // create row
                $evalPosterNotationRepo->insertNoteGroupePoster($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
                
                $moyPost = $moyenneRepo->moyennePoster($groupId);
                $groupe->setNotePoster((float)$moyPost[0]["moyPoster"]);

                $entityManager->persist($groupe);
                $entityManager->flush();
                
                $notes = $var[0];
                $this->addFlash('success', 'Notes insérées avec succès');
            }
        }

        return $this->render('evaluator/group/notes/poster/students_poster.html.twig',[
            'groupId' => $groupId,
            'formNotation' => $formNotation->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            'notes' => $notes
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
                $noteTut20 = $datas['noteTut20'.$etudiant->getIdEtud()];
                
                $etudiant->setNoteTutRapport((float)$noteTutRapport);
                $etudiant->setNoteTutTrav((float)$noteTutTrav);
                $etudiant->setNoteTutCompet((float)$noteTutCompt);
                $etudiant->setPourcentTravail((float)$poucentTravail);
                $etudiant->setNoteTut20((float)$noteTut20);

                
                
                $entityManager->persist($etudiant);
            }
            $entityManager->flush();
            $this->addFlash('success', 'Les notes ont été enregistrées avec succès');

        }
        return $this->render('evaluator/group/notes/indiv/students_eval.html.twig',[
            'groupe' => $groupe,
            'etudiants' => $etudiants,
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

    // affiche la liste des groupes pour la gestion des soutenances
    public function showNoteGroupSout(EvalGroupeRepository $evalGroupeRepo){

        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        // $groupes = $repo->findAll();
        $groupes = [];
        $valeurs = $evalGroupeRepo->findAllGroupSout($this->getUser()->getIdUser());
        foreach ($valeurs as $valeur) {

            $groupId = $valeur["id_groupe_eval_sout"];
            $groupe = $repo->find($groupId);
            $groupes[] = $groupe;
        }

        // On sélectionne en fonction de la promo
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        $allGroupes = $groupes;
        $groupes = [];
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupes[] = $groupe;
            }
        }
        // dd($groupes);
        $total = count($groupes);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('evaluator/group/notes/soutenance/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }
    
    // affiche la liste des groupes pour la gestion des posters
    public function showNoteGroupPost(EvalGroupeRepository $evalGroupeRepo){

        // $repo = $this->getDoctrine()->getRepository(Groupe::class);
        // $groupes = $repo->findAll();
        
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = [];
        $valeurs = $evalGroupeRepo->findAllGroupPost($this->getUser()->getIdUser());
        foreach ($valeurs as $valeur) {
            $groupId = $valeur["id_groupe_eval_post"];
            $groupe = $repo->find($groupId);
            $groupes[] = $groupe;
        }
        
        // On sélectionne en fonction de la promo
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        $allGroupes = $groupes;
        $groupes = [];
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupes[] = $groupe;
            }
        }
        $total = count($groupes);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();
        
        return $this->render('evaluator/group/notes/poster/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }
    
    // affiche la liste des groupes dont l'utilisateur est encadrant
    public function showNoteGroupIndiv(EvalGroupeRepository $evalGroupeRepo){
        
        
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $allGroupes = $repo->findAll();
        $groupes = [];
        // $allGroupes = [];
        // // On récupère tous les groupes à évaluer
        // $valeurs = $evalGroupeRepo->findAllGroupSout($this->getUser()->getIdUser());
        // foreach ($valeurs as $valeur) {
            //     $groupId = $valeur["id_groupe_eval_sout"];
            //     $groupe = $repo->find($groupId);
            //     $allGroupes[] = $groupe;
            // }
            // On cherche les groupes dont l'utilisateur est évaluateur
        foreach ($allGroupes as $groupe) {
            $evals = $groupe->getIdProjet()->getIdEval();
            foreach ($evals as $eval) {
                if ($eval->getIdUser() == $this->getUser()->getIdUser()) {
                    $groupes[] = $groupe;
                }
            }
        }

        // On sélectionne en fonction de la promo
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        $allGroupes = $groupes;
        $groupes = [];
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupes[] = $groupe;
            }
        }

        $total = count($groupes);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findAll();

        return $this->render('evaluator/group/notes/indiv/group_list.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }
 
}