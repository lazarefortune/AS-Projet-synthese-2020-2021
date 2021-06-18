<?php


namespace App\Controller\Etudiant;

use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


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
}