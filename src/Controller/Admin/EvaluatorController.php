<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class EvaluatorController extends AbstractController
{
    public function list(Request $request, PaginatorInterface $paginator, UserRepository $repository): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        // $donnees = $entityManager->getRepository(User::class)->findAll();
        $donnees =  $repository->findByRole("EVALUATOR");    
        $users = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
        
        return $this->render('admin/evaluator/list.html.twig', [
            'users' => $users
        ]);
    }
}
