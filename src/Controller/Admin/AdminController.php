<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    
    public function index(): Response
    {

        return $this->render('admin/website/access.html.twig');
    }

  
public function usersList(UserRepository $users)
{
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
}

}