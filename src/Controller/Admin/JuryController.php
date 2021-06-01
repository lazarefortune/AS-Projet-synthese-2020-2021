<?php

namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class JuryController extends AbstractController
{
    public function show(): Response{
        return $this->render('admin/planning/editJury.html.twig');
    }
}
