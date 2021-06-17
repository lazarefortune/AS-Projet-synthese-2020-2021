<?php

namespace App\Controller\Evaluator;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eval/list", name="list_eval")
 */
class EvalListController extends AbstractController
{
    public function list(Request $request, PaginatorInterface $paginator, UserRepository $repository): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $donnees = $repository->findByRole("EVALUATOR");

        $users = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('evaluator/list.html.twig', [
            'users' => $users
        ]);
    }
}