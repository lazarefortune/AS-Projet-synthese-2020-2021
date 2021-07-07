<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class EmailController extends AbstractController
{
    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function index(): Response
    {

        return $this->render('admin/email.html.twig');
    }
}
