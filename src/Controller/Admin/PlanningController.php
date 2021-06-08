<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    /**
     * @Route("/planning", name="planning")
     */
    public function planning(): Response
    {
        return $this->render('admin/planning/planning.html.twig', [
            'controller_name' => 'PlanningController',
        ]);
    }
}
