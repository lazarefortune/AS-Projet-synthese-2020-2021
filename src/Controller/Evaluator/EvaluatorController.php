<?php


namespace App\Controller\Evaluator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class EvaluatorController extends AbstractController {
    /**
     * @Route("/eval", name="evaluator_home")
     */
    public function index(): Response{
        return $this->render('evaluator/index.html.twig');
    }
}