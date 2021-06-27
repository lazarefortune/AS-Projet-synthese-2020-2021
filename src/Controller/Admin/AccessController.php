<?php

namespace App\Controller\Admin;

use App\Entity\DateAccesSout;
use App\Form\DateAccessSoutType;
use App\Repository\DateAccessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AccessController extends AbstractController
{
    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function dates_index(DateAccessRepository $dateAccessRepo): Response
    {
        $allDate = $dateAccessRepo->findAll();
        // foreach ($allDate as $dateTime) {

        //     dd($dateTime->getDateDebut());
        // }
        return $this->render('admin/website/access.html.twig', [
            'allDate' => $allDate
        ]);
    }

    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function add_dates_index(Request $request): Response
    {
        $dateTime = new DateAccesSout();
        $formDateAccess = $this->createForm(DateAccessSoutType::class, $dateTime);


        $formDateAccess->handleRequest($request);
        if ($formDateAccess->isSubmitted() && $formDateAccess->isValid()) {
            // dd($formDateAccess);

            $dateTime = $formDateAccess->getData();
            $dateDeb = $dateTime->getDateDebut();
            $dateFin = $dateTime->getDateFin();
            dump($dateDeb);
            dump($dateFin);
            dump($dateDeb < $dateFin);
            if($dateDeb < $dateFin){
                $this->addFlash('danger', 'Erreur! Date de début supérieur à la date de fin');
                return $this->redirectToRoute('define_dates');
            }
            die;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dateTime);
            $entityManager->flush();
            $this->addFlash('success', 'Créneau ajouté avec succès');
            return $this->redirectToRoute('define_dates');
        }

        return $this->render('admin/website/addAccessDate.html.twig', [
            'formDateAccess' => $formDateAccess->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function edit_dates_index(Request $request, $id, DateAccessRepository $dateAccessRepo): Response
    {
        // $dateTime = new DateAccesSout();
        $dateTime = $dateAccessRepo->findBy([
            'idDSout' => $id
        ]);
        $dateTime = $dateTime[0];
        // dd($dateTime);
        $formDateAccess = $this->createForm(DateAccessSoutType::class, $dateTime);


        $formDateAccess->handleRequest($request);
        if ($formDateAccess->isSubmitted() && $formDateAccess->isValid()) {
            // dd($formDateAccess);
            $dateTime = $formDateAccess->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dateTime);
            $entityManager->flush();
            $this->addFlash('info', 'Créneau modifié avec succès');
            // return $this->redirectToRoute('define_dates');
        }

        return $this->render('admin/website/editAccessDate.html.twig', [
            'dateTime' => $dateTime,
            'formDateAccess' => $formDateAccess->createView()
        ]);
    }

    public function delete_dates_index(Request $request, $id, DateAccessRepository $dateAccessRepo)
    {

        $dateTime = $dateAccessRepo->find($id);
        if($dateTime == null){

            $this->addFlash('danger', 'Aucun créneau ne correspond');
            return $this->redirectToRoute('define_dates');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($dateTime);
        $entityManager->flush();
        $this->addFlash('warning', 'Créneau <b>supprimé</b> avec succès');
        return $this->redirectToRoute('define_dates');
    }
}
