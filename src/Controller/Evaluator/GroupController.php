<?php

namespace App\Controller\Evaluator;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Form\EvalNotationType;
use App\Repository\EvalSoutNotationRepository;
use App\Repository\EvalPosterNotationRepository;
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
    public function group_notes_sout(int $groupId, Request $request, EvalSoutNotationRepository $evalSoutNotationRepo)
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
                $this->addFlash('success', 'Notes mis à jour avec succès');

                    //update vue
                $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
                $notes = $var[0];
            }else{
                // create row
                $evalSoutNotationRepo->insertNoteGroupeSout($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                $var = $evalSoutNotationRepo->findIsEvalNotationSout($this->getUser()->getIdUser(), $groupe->getId(), "eval_sout");
                $notes = $var[0];
                $this->addFlash('success', 'Notes insérées avec succès');
            }
        }
    
        return $this->render('evaluator/group/notes/students_sout.html.twig',[
            'groupId' => $groupId,
            'formNotation' => $formNotation->createView(),
            'groupe' => $groupe,
            'etudiants' => $etudiants,
            'notes' => $notes
            ]);
    }

    public function group_notes_poster(int $groupId, Request $request, EvalPosterNotationRepository $evalPosterNotationRepo)
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
                $this->addFlash('success', 'Notes mis à jour avec succès');

                    //update vue
                $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
                $notes = $var[0];
            }else{
                // create row
                $evalPosterNotationRepo->insertNoteGroupePoster($datas["qualPres"], $datas["trav"], $datas["compet"], $datas["moyenne"], $this->getUser()->getIdUser(), $groupe->getId());
                $var = $evalPosterNotationRepo->findIsEvalNotationPoster($this->getUser()->getIdUser(), $groupe->getId(), "eval_poster");
                $notes = $var[0];
                $this->addFlash('success', 'Notes insérées avec succès');
            }
        }

        return $this->render('evaluator/group/notes/students_poster.html.twig',[
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
                $noteFinale = $datas['noteFinale'.$etudiant->getIdEtud()];
                
                $etudiant->setNoteTutRapport((float)$noteTutRapport);
                $etudiant->setNoteTutTrav((float)$noteTutTrav);
                $etudiant->setNoteTutCompet((float)$noteTutCompt);
                $etudiant->setPourcentTravail((float)$poucentTravail);
                $etudiant->setNoteFinale((float)$noteFinale);

                
                // $constraint = new Assert\Collection([
                
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