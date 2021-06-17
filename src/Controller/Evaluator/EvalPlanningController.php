<?php


namespace App\Controller\Evaluator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvalPlanningController extends AbstractController
{
    /**
     * @Route("/eval/planning", name="planning_eval")
     */
    public function planning(): Response
    {
        return $this->render('evaluator/planning.html.twig', [
            'controller_name' => 'PlanningController',
        ]);
    }

}