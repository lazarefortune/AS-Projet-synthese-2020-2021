<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function index(PromoRepository $promoRepo, Request $request) {
        
        $hasAccess = $this->isGranted('ROLE_ADMIN');
        if (!$hasAccess) {
            
            return $this->render('evaluator/index.html.twig');
        }
        
        $promos = $promoRepo->findAll();
        $this->get('session')->set('promos', $promos);

        if ($request->isMethod("post")) {
            $datas = $request->request->all();
            // dd($datas);

            $promo = $promoRepo->findBy([
                'id' => $datas["promo"]
            ]);
            $promo =$promo[0];
            // dd($this->get('session')->get('promo'));
            $this->get('session')->set('promo', $promo);
        }
        else{
            if (!$this->get('session')->get('promo')) {
                $promo = $promos[0];
            //     $time = new \DateTime();
            //     // on fait le choix du type de promo
            //     $typePromo = "AS";
        
            //     $nowMounth = (int)$time->format('m');
            //     $nowYear = (int)$time->format('Y-m-d');
            //    // On récupère l'année universitaire 
            //     if ($nowMounth <= 9) {
            //         $anneeUniv = $nowYear-1;
            //     }else{
            //         $anneeUniv = $nowYear;
            //     }
            $this->get('session')->set('promo', $promo);
                
            }
        }

        // dd($typePromo);
        // // on récupère la promo
        // $promo = $promoRepo->findBy([
        //     'anneeUniv' => $anneeUniv,
        //     'typePromo' => $typePromo
        // ]);
        // if (!$promo) {
        //     $time = new \DateTime();
    
        //     $nowMounth = (int)$time->format('m');
        //     $nowYear = (int)$time->format('Y-m-d');
        //    // On récupère l'année universitaire 
        //     if ($nowMounth <= 9) {
        //         $anneeUniv = $nowYear-1;
        //     }else{
        //         $anneeUniv = $nowYear;
        //     }
        //     $promo = $promoRepo->findBy([
        //         'anneeUniv' => $anneeUniv,
        //         'typePromo' => $typePromo
        //     ]);
        // }
        // On garde en session
        // $this->get('session')->set('promo', $promo);
        // dd($promo);
        // on récupère la promo.
        // dd($time->format('Y-m-d'));
        
        return $this->render('admin/index.html.twig');
    }
}
