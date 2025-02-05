<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPassType;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use App\Repository\EvalGroupeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/mot-de-passe/recuperation", name="forgotten_password")
     */
    public function password_reset_form(UserRepository $users, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, Request $request): Response
    {

        // $users = $this->getDoctrine()->getRepository(User::class);
        // On initialise le formulaire
        $form = $this->createForm(ResetPassType::class);

        // On traite le formulaire
        $form->handleRequest($request);

        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données
            $donnees = $form->getData();

            // On cherche un utilisateur ayant cet e-mail
            $user = $users->findByUsername($donnees['email']);

            // Si l'utilisateur n'existe pas
            if ($user === null) {
                // On envoie une alerte disant que l'adresse e-mail est inconnue
                $this->addFlash('danger', 'Cet identifiant est inconnu');

                // On retourne sur la page d'oublie de mot de passe
                return $this->redirectToRoute('forgotten_password');
            }
            if ($user->getEmail() === null) {
                $this->addFlash('danger', 'Cet utilisateur ne possède pas d\'adresse mail');

                // On retourne sur la page d'oublie de mot de passe
                return $this->redirectToRoute('forgotten_password');
            }
            // On génère un token
            $token = $tokenGenerator->generateToken();

            // On essaie d'écrire le token en base de données
            try {
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('password_reset');
            }

            // On génère l'URL de réinitialisation de mot de passe
            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            // On génère l'e-mail
            $message = (new \Swift_Message('Mot de passe oublié - EPT - IUT de Metz'))
                ->setFrom('servicefortuneindustry@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('auth/emails/reset_pass.html.twig',
                    [
                        'user' => $user,
                        'url' => $url
                    ]), 'text/html'
                    // "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site de gestion des projet tuteurés de l'IUT de Metz (Université de Lorraine). Veuillez cliquer sur le lien suivant : " . $url,
                    // 'text/html'
                );
            //dd($mailer);
            // On envoie l'e-mail
            $mailer->send($message);

            // On crée le message flash de confirmation
            $this->addFlash('success', 'E-mail de réinitialisation du mot de passe envoyé !');

            // On redirige vers la page de soumission
            return $this->redirectToRoute('forgotten_password');
        }

        // On envoie le formulaire à la vue
        // return $this->render('security/forgotten_password.html.twig', ['emailForm' => $form->createView()]);

        return $this->render('auth/password/forgotten.html.twig', ['emailForm' => $form->createView()]);
    }


    /**
     * @Route("/mot-de-passe/recuperation/{token}", name="reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        // On cherche un utilisateur avec le token donné
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('forgotten_password');
        }

        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);

            // On chiffre le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // On crée le message flash
            $this->addFlash('success', 'Mot de passe mis à jour, connectez-vous');

            // On redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        } else {
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('auth/password/reset_password.html.twig', [
                'token' => $token,
                'user' => $user
            ]);
        }
    }

    /**
     * @Route("/mot-de-passe/vue", name="vue")
     */
    public function see(){
        $url = null;
        return $this->render('auth/emails/reset_pass.html.twig', [
            'url' => $url,
        ]);
    }
}
