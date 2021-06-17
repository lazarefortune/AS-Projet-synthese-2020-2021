<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\EvalType;
use App\Form\EvalUpdateType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EvaluatorController extends AbstractController
{
    public function list(Request $request, PaginatorInterface $paginator, UserRepository $repository): Response
    {
        $user = new User();
        $entityManager = $this->getDoctrine()->getManager();
        $donnees =  $repository->findByRole("EVALUATOR");
        $max_id = $repository->getMaxId();
        $user->setIdUser($max_id+1);
        $form = $this->createForm(EvalType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvel utilisateur enregistré avec succès');
            return $this->redirectToRoute('evaluator_list');
        }
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
        }
        $users = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
        
        return $this->render('admin/evaluator/list.html.twig', [
            'users' => $users,
            'user'  => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/admin/evaluateurs/modifier/{id}", name="update_eval", methods={"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return Response
     */
    public function update(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $eval = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(EvalUpdateType::class, $eval, [
            'action' => $this->generateUrl('update_eval', ['id' => $id])
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eval);
            $entityManager->flush();
            $this->addFlash('success', 'Données mises à jour avec succès');
            return $this->redirectToRoute('evaluator_list');
        }
        return $this->render(
            'admin/evaluator/update.html.twig', array('form' => $form->createView(), 'eval' => $eval
            )
        );
    }

    /**
     *
     * @Route("/admin/evaluateurs/supprimer/{id}", name="delete_eval", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $id
     * @return Response
     */
    public function delete(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $eval = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($eval);
        $entityManager->flush();
        $this->addFlash('success', 'L\'utilisateur a été supprimé avec succès');
        return $this->redirectToRoute('evaluator_list');
    }


}
