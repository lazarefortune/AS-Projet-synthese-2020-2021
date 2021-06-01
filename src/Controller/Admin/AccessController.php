<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AccessController extends AbstractController
{
    public function dates_index(): Response
    {

        return $this->render('admin/website/access.html.twig');
    }
    
    public function add_dates_index(): Response
    {

        return $this->render('admin/website/addAccessDate.html.twig');
    }
}