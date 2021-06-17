<?php

namespace App\Controller\Admin;
use App\Entity\Projet;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;



class JuryController extends AbstractController
{

    public function show(UserRepository $repo): Response{

        $repoProjet = $this->getDoctrine()->getRepository(Projet::class);

        $projets = $repoProjet->findAll();
        $users = $repo->findByRole("EVALUATOR");

        return $this->render('admin/planning/editJury.html.twig',
            ["users" => $users,
                "projets" => $projets]);

    }
}


