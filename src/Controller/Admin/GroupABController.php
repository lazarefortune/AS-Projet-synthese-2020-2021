<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Etudiant;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Entity\Projet;
use Dompdf\Dompdf;
use Dompdf\Options;

class GroupABController extends AbstractController
{

    public function edit(UserRepository $repo): Response{

        //$repoUser = $this->getDoctrine()->getRepository(User::class);
        $repoProjet = $this->getDoctrine()->getRepository(Projet::class);

        $projets = $repoProjet->findAll();
        $users = $repo->findByRole("EVALUATOR");

        return $this->render('admin/planning/editGroupAB.html.twig',
            ["users" => $users,
                "projets" => $projets]);

    }

    public function show(): Response{

        $repo = $this->getDoctrine()->getRepository(Etudiant::class);

        $etudiants = $repo->findAll();
        return $this->render('admin/planning/groupView.html.twig',
        ["etudiants" => $etudiants]);
    }


}

