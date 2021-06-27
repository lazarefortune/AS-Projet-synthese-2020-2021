<?php


namespace App\Controller\Etudiant;

use Twig\Environment;
use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Repository\MoyenneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EtudiantController extends AbstractController {
  
    public function index(): Response{

        $repo = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiant = $repo->findBy([
            'idUser' => $this->getUser()->getIdUser()
        ]);
        if($etudiant){
            $etudiant = $etudiant[0];
        }
        // dd($etudiant);
        return $this->render('etudiant/index.html.twig',[
            'etudiant' => $etudiant
        ]);
    }

    // public function notes_group_sout(){

    //     $user = $this->getUser();
        
    //     $repoUser = $this->getDoctrine()->getRepository(Etudiant::class);
    //     $etudiant = $repoUser->findBy([
    //         'idUser' => $user->getIdUser()
    //     ]);
    //     $etudiant = $etudiant[0];
    //     // dd($etudiant);
    //     $groupId = $etudiant->getIdGroupeEtud();
    //     $repo = $this->getDoctrine()->getRepository(Groupe::class);
    //     $groupe = $repo->find($groupId);

    //     $repoEtudiants = $this->getDoctrine()->getRepository(Etudiant::class);
    //     $etudiants = $repoEtudiants->findBy([
    //         'idGroupeEtud' => $groupId
    //     ]);

    //     return $this->render('etudiant/notes/soutenance.html.twig',[
    //         'etudiants' => $etudiants,
    //         'groupe' => $groupe
    //     ]);
    // }

    public function notes_group_sout(MoyenneRepository $moyenneRepo): Response
    {
        $user = $this->getUser();

        $repo = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiant = $repo->findBy([
            'idUser' => $user->getIdUser()
        ]);
        $etudiant = $etudiant[0];
        $groupe = $etudiant->getIdGroupeEtud();
        
        $repo2 = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiants = $repo2->findBy([
            'idGroupeEtud' => $groupe->getId()
        ]);

        $moySout = $moyenneRepo->moyenneSout($groupe->getId());
        $moyPost = $moyenneRepo->moyennePoster($groupe->getId());

        $repo = $this->getDoctrine()->getRepository(Etudiant::class);
        $etudiant = $repo->findBy([
            'idUser' => $this->getUser()->getIdUser()
        ]);
        if($etudiant){
            $etudiant = $etudiant[0];
        }

        return $this->render('etudiant/notes/soutenance.html.twig',[
            'groupe'    => $groupe,
            'etudiants' => $etudiants,
            'moySout'   => $moySout,
            'moyPost'   => $moyPost,
            'etudiant' => $etudiant
            ]);
    }
}