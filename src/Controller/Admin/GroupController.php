<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use App\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        // foreach($groupes as $groupes){
        //     dump(count($etudiants));
        // }

        return $this->render('admin/group/list_notes.html.twig', [
            'groupes'   => $groupes,
            'etudiants' => $etudiants,
            'total'     => $total
        ]);
    }

    public function group_list(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupes = $repo->findAll();

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
        
        return $this->render('admin/group/notes/show.html.twig',[
            'groupId' => $groupId,
            'groupe' => $groupe,
            'etudiants' => $etudiants
            ]);
    }

    public function edit_note(int $groupId, string $typeEval){
        $repo = $this->getDoctrine()->getRepository(Groupe::class);
        $groupe = $repo->find($groupId);

        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupId
        ]);

        if ($typeEval == "soutenance") {
            $this->addFlash('success', 'Notes mis à jour avec succès');
            return $this->render('admin/group/notes/edit_sout.html.twig',[
                'groupId' => $groupId,
                'groupe' => $groupe,
                'etudiants' => $etudiants
            ]);
        }
        if ($typeEval == "poster") {
            return $this->render('admin/group/notes/edit_poster.html.twig',[
                'groupId' => $groupId,
                'groupe' => $groupe,
                'etudiants' => $etudiants
                ]);
        }
    }
 
}
