<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;



class JuryController extends AbstractController
{
    public function show(UserRepository $repo): Response{
        //$repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findByRole("EVALUATOR");

        return $this->render('admin/planning/editJury.html.twig',
            ['users' => $users]);
    }
}


