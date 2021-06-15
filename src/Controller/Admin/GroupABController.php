<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Entity\Projet;
use Dompdf\Dompdf;
use Dompdf\Options;

class GroupABController extends AbstractController
{

    public function show(): Response{
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('admin/planning/groupView.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true]);

    }

    public function index(UserRepository $repo): Response{

        //$repoUser = $this->getDoctrine()->getRepository(User::class);
        $repoProjet = $this->getDoctrine()->getRepository(Projet::class);

        $projets = $repoProjet->findAll();
        $users = $repo->findByRole("EVALUATOR");

        return $this->render('admin/planning/editGroupAB.html.twig',
            ["users" => $users,
                "projets" => $projets]);

    }


}

