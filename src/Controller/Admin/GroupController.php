<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\EvalNotationType;
use App\Repository\EvalSoutNotationRepository;
use App\Repository\EvalPosterNotationRepository;
use App\Repository\MoyenneRepository;

class GroupController extends AbstractController
{

    public function list_note(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        // $groupes = $repo->findAll();
        $allGroupes = $repo->findAll();
        
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupes[] = $groupe;
            }
        }

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
        
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
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
    
    public function group_notes(int $groupId, MoyenneRepository $moyenneRepo): Response
    {
        $repo1 = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo1->find($groupId);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        $moySout = $moyenneRepo->moyenneSout($groupId);
        $groupe->setNoteSout((float)$moySout[0]["moySoutenance"]);
        dump($groupe);
        dump($moySout[0]["moySoutenance"]);
        dump((float)$moySout[0]["moySoutenance"]);
        
        $moyPost = $moyenneRepo->moyennePoster($groupId);
        $groupe->setNotePoster((float)$moyPost[0]["moyPoster"]);
        
        return $this->render('admin/group/notes/show.html.twig',[
            'groupId'   => $groupId,
            'groupe'    => $groupe,
            'etudiants' => $etudiants,
            'moySout'   => $moySout,
            'moyPost'   => $moyPost,
            ]);
    }



    public function list_eval(int $groupId, string $typeEval, EvalSoutNotationRepository $evalSoutNotationRepo, EvalPosterNotationRepository $evalPosterNotationRepo){
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);
        
        $repo2 = $this->getDoctrine()->getRepository(User::class);

        $listEval = [];
        
        if ($typeEval == "soutenance") {
            $evalsSout = $evalSoutNotationRepo->selectAllNotesSout($groupId);
            foreach ($evalsSout as $eval) {
                $listEval[] = $repo2->find((int)$eval['id_eval_sout']);
            }
            
            if(!$listEval)
                $this->addFlash(
                   'info',
                   'Aucun évalatueur à noter ce groupe'
                );

            return $this->render('admin/group/notes/list_sout_eval.html.twig',[
                'groupId' => $groupId,
                'groupe'  => $groupe,
                'evals'   => $listEval,
            ]);
        }
        if ($typeEval == "poster") {
            $evalsPoster = $evalPosterNotationRepo->selectAllNotesPoster($groupId);
            foreach ($evalsPoster as $eval) {
                $listEval[] = $repo2->find((int)$eval['id_eval_post']);
            }

            if(!$listEval)
                $this->addFlash(
                   'info',
                   'Aucun évalatueur à noter ce groupe'
                );

            return $this->render('admin/group/notes/list_poster_eval.html.twig',[
                'groupId' => $groupId,
                'groupe' => $groupe,
                'evals'   => $listEval,
                ]);
        }
    }        
        
    public function group_notes_sout(int $groupId, int $idEval, Request $request, EvalSoutNotationRepository $evalSoutNotationRepo)
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $eval = $repoUser->find($idEval);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);
        $var = $evalSoutNotationRepo->findIsEvalNotationSout($idEval, $groupe->getId());
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
        
        $formNotation = $this->createForm(EvalNotationType::class);
        if($request->isMethod('post')){
            $var = $evalSoutNotationRepo->findIsEvalNotationSout($idEval, $groupe->getId());
            // get data of form
            $datas = $request->request->all();
            $datas = $datas["eval_notation"];
            // on test si on a déjà noté ce groupe
            if($var){
                // update row 
                $evalSoutNotationRepo->updateNoteGroupeSout($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $idEval, $groupe->getId());
                $this->addFlash('success', 'Notes mis à jour avec succès');
                
                //update vue
                $var = $evalSoutNotationRepo->findIsEvalNotationSout($idEval, $groupe->getId());
                $notes = $var[0];
            } else {
                $this->addFlash('danger', 'Vous ne pouvez pas insérer de notes');

            }
        }
    
        return $this->render('admin/group/notes/soutenance/students_sout.html.twig',[
            'groupId' => $groupId,
            'formNotation' => $formNotation->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            'notes' => $notes,
            'eval' => $eval,
            ]);
        }
        
    public function group_notes_poster(int $groupId, int $idEval, Request $request, EvalPosterNotationRepository $evalPosterNotationRepo)
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $eval = $repoUser->find($idEval);
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);
        $var = $evalPosterNotationRepo->findIsEvalNotationPoster($idEval, $groupe->getId());
        //  if note exists
        if($var){
            // update row note poster
            $notes = $var[0];
        }else{
            // create row note poster
            $notes = [
                "post_qual_pres" => null,
                "post_trav" => null,
                "post_compet" => null,
                "post_moyenne" => null
            ];
        }
        
        $formNotation = $this->createForm(EvalNotationType::class);
        if($request->isMethod('post')){
            $var = $evalPosterNotationRepo->findIsEvalNotationPoster($idEval, $groupe->getId());
            // get data of form
            $datas = $request->request->all();
            $datas = $datas["eval_notation"];
            // on test si on a déjà noté ce groupe
            if($var){
                // update row 
                $evalPosterNotationRepo->updateNoteGroupePoster($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $idEval, $groupe->getId());
                $this->addFlash('success', 'Notes mis à jour avec succès');
                
                //update vue
                $var = $evalPosterNotationRepo->findIsEvalNotationPoster($idEval, $groupe->getId());
                $notes = $var[0];
            } else {
                $this->addFlash('danger', 'Vous ne pouvez pas insérer de notes');

            }
        }
    
        return $this->render('admin/group/notes/poster/students_poster.html.twig',[
            'groupId' => $groupId,
            'formNotation' => $formNotation->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            'notes' => $notes,
            'eval' => $eval,
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
                // dd((float)$noteTutRapport);
                // dd((float)$noteTutRapport);
                $etudiant->setNoteTutRapport((float)$noteTutRapport);
                // dd($etudiant->getNoteTutRapport());
                $etudiant->setNoteTutTrav((float)$noteTutTrav);
                $etudiant->setNoteTutCompet((float)$noteTutCompt);
                $etudiant->setPourcentTravail((float)$poucentTravail);
                $etudiant->setNoteTut20((float)$noteTut20);

                
                // $constraint = new Assert\Collection([
                
                $entityManager->persist($etudiant);
            }
            $entityManager->flush();
            $this->addFlash('success', 'Les notes ont été enregistrées avec succès');

        }
        return $this->render('admin/group/notes/indiv/students_eval.html.twig',[
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            ]);
    }
}
