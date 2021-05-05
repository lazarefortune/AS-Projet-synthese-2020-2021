<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EvaluatorController extends AbstractController
{
    public function list(): Response
    {

        return $this->render('admin/evaluator/list.html.twig');
    }
}
