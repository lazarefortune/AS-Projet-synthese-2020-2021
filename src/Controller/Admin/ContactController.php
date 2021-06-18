<?php

namespace App\Controller\Admin;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="email")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        $formContact = $this->createForm(ContactType::class);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contact = $formContact->getData();

            // Ici nous enverrons l'e-mail
            // On crée le message
            $message = (new \Swift_Message('Nouveau contact'))
                // On attribue l'expéditeur
                ->setFrom($contact['email'])
                // On attribue le destinataire
                ->setTo('servicefortuneindustry@gmail.com')
                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                        'layouts/emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);


            $this->addFlash('success', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
        }
        return $this->render('admin/contact/index.html.twig',['formContact' => $formContact->createView()]);
    }

}
