<?php


namespace App\Controller\Evaluator;

use Twig\Environment;
use App\Entity\Groupe;
use App\Repository\PromoRepository;
use App\Repository\EvalGroupeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvaluatorController extends AbstractController
{
    /**
     * @Route("/eval", name="evaluator_home")
     */
    public function index(EvalGroupeRepository $evalGroupeRepo, Request $request, PromoRepository $promoRepo): Response
    {
        

        $promos = $promoRepo->findAll();
        $this->get('session')->set('promos', $promos);

        if ($request->isMethod("post")) {
            $datas = $request->request->all();
            // dd($datas);

            $promo = $promoRepo->findBy([
                'id' => $datas["promo"]
            ]);
            $promo = $promo[0];
            // dd($this->get('session')->get('promo'));
            $this->get('session')->set('promo', $promo);
        } else {
            if (!$this->get('session')->get('promo')) {
                $promo = $promos[0];
                $this->get('session')->set('promo', $promo);
            }
        }

        $repo = $this->getDoctrine()->getRepository(Groupe::class);


        $valeursSout = $evalGroupeRepo->findAllGroupSout($this->getUser()->getIdUser());
        $groupesSout = [];
        foreach ($valeursSout as $valeur) {
            $groupId = $valeur["id_groupe_eval_sout"];
            $groupe = $repo->find($groupId);
            $groupesSout[] = $groupe;
        }

        // On sélectionne en fonction de la promo
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        $allGroupes = $groupesSout;
        $groupesSout = [];
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupesSout[] = $groupe;
            }
        }
        // dump($groupesSout);
        
        $groupesPost = [];
        $valeursPost = $evalGroupeRepo->findAllGroupPost($this->getUser()->getIdUser());
        foreach ($valeursPost as $valeur) {
            $groupId = $valeur["id_groupe_eval_post"];
            $groupe = $repo->find($groupId);
            $groupesPost[] = $groupe;
        }
        
        // On sélectionne en fonction de la promo
        $idPromoSession = $this->get('session')->get('promo')->getId();
        // il faut faire une find par promo
        $allGroupes = $groupesPost;
        $groupesPost = [];
        foreach ($allGroupes as $groupe) {
            $idPromoGroup = $groupe->getIdProjet()->getIdPromoProj()->getId();
            if($idPromoGroup == $idPromoSession){
                $groupesPost[] = $groupe;
            }
        }
        // dump($groupesPost);

        // return $this->redirectToRoute('evaluator_home');
        
        return $this->render('evaluator/index.html.twig',[
            'groupesSout' => $groupesSout,
            'groupesPost' => $groupesPost
        ]);
    }
}
